<?php
include("conectadb.php");
include("topo.php");

// COLETA DADOS DO POST
 $tipo_cupom = ""; //inicia a variavel caso não tenha cupom 

  //verifica a data de validade do cupom
  $data_atual = date('Y-m-d');
  $data_validade = '2000-01-01';//inicia a variavel caso não tenha cupom (coloquei ano 2000 para não dar erro)
  $desconto = "";//inicia a variavel caso não tenha cupom 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idcliente = ($_POST['nomecliente']);
  $codigo = ($_POST['codigo']);
  //echo $codigo;

  #PESQUISA O CUPOM
  $sqlcupom = "SELECT * FROM tb_cupons WHERE codigo = '$codigo'";
  $retornocupom = mysqli_query($link, $sqlcupom);
  while ($tblcupom = mysqli_fetch_array($retornocupom)) {
      $desconto = $tblcupom[2];
      $tipo_cupom = $tblcupom[3];
      $data_validade = $tblcupom[4];
      }

  #PESQUISA OS ITENS DA COMPRA
  $sql = "SELECT * FROM tb_item_venda WHERE iv_status = 1";

  # usado apra fazer a remoção dos itens do inventario
  $retornoproduto = mysqli_query($link, $sql);

  # usado para fazer o total
  $total = 0; // Inicializa a variável total para guardar o valor de venda
  $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_status = 1"; 
  $retornovalortotal = mysqli_query($link, $valortotal);

  while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)) {
    $total = $tblvalortotal[0];
  }

#ADD CUPOM


  if (strtotime($data_validade) >= strtotime($data_atual)) {

    //verifica se o cupom já foi usado pelo cliete
    $sqlclientecupom = "SELECT COUNT(fk_cli_id) FROM tb_venda WHERE cupom = '$desconto'";
    $retornoclientecupom = mysqli_query($link, $sqlclientecupom);
    while ($tblclientecupom = mysqli_fetch_array($retornoclientecupom)) {
        $clientecupom = $tblclientecupom[0];
    }
    //echo $clientecupom .'----------'.$idcliente;

    if ($clientecupom < 1 and $idcliente != 1 ){ //idcliente 1 = vazio
      echo 'cliente ok';
        //verifica o tipo de desconto
                if ($tipo_cupom == 'fixo'){
                    $total -=$desconto;
                }
                else if ($tipo_cupom == 'porcentagem'){
                    $total -=(($desconto*$total)/100);
                }else{
                    $total = $total;
                }
        }
    }else{
        $total = $total; //não precisa mas por precaução né
    }

  //verifica se o desconto é maior do que o total
  if ($total < 0){
    $total = 0;
  }

  #usado para fazer a finalização do carrinho
  $retornocarrinho = mysqli_query($link, $sql);
  $usuario = $_SESSION['idusuario'];

################### FALTA VERIFICAR SE TEM ITEM NO INVENTARIO ################# UC 11

  #TIRA OS ITENS DO INVENTARIO      
  while ($tblitem = mysqli_fetch_array($retornoproduto)) {
    $produto_id = $tblitem[4]; // ID do produto
    $quantidade_item = $tblitem[2]; // Quantidade do item na compra

    // Consulta para obter a quantidade atual do produto
    $sqlproduto = "SELECT pro_quantidade FROM tb_produtos WHERE pro_id = $produto_id";
    $retornoproduto_info = mysqli_query($link, $sqlproduto);
    
    // Atualiza a quantidade do produto
    if ($row = mysqli_fetch_array($retornoproduto_info)) { 
        $quantidade_produto = $row[0]; 
        $nova_quantidade = $quantidade_produto - $quantidade_item;
        
        $sql_update_produto = "UPDATE tb_produtos SET pro_quantidade = $nova_quantidade 
        WHERE pro_id = $produto_id";
        $resultado_update_produto = mysqli_query($link, $sql_update_produto);
    }
  }


  $tbl = mysqli_fetch_array($retornocarrinho);
  #INCLUI O TOTAL, DATA DA VENDA E FINALIZA O CARRINHO
  $data = date("Y-m-d H:i:s"); #pegando o dia atual


  $sqlvenda = "INSERT INTO tb_venda (ven_datavenda, ven_totalvenda, fk_iv_cod_iv, `fk_cli_id`, `fk_usu_id`, cupom) 
  VALUES ('$data',$total,'$tbl[3]',$idcliente,$usuario, '$codigo')";
  echo $sqlvenda;
  mysqli_query($link,$sqlvenda);

  //FINALIZA A VENDA TROCANDO O STATUS DE ABERTO PARA FECHADO
  $sqlfechavenda = "UPDATE tb_item_venda SET iv_status = 0 WHERE iv_status = 1";
  //echo $sqlfechavenda;
  mysqli_query($link,$sqlfechavenda);

  header("Location: backoffice.php");
}