<?php
include("conectadb.php");
include("topo.php");

// VERIFICAR SESSION VAZIO
//session_start();

// APÓS O CLIQUE DE ADD FAÇA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $produto = $_POST['produto'];
    // QUEBRA AS 3 VARIAVEIS TRAZIDA PELO $PRODUTO EM 3 VARIAVEIS NOVAS
    list($idproduto, $nomeproduto, $valorproduto) = explode(',', $produto); 
    $qtditem = $_POST['qtditem'];

    //CALCULANDO VALOR ITENS
    $valorlista = $valorproduto * $_POST['qtditem'];

    #VERIFICA SE EXISTE UM CARRINHO JÁ ABERTO
    $sql = "SELECT COUNT(iv_status) FROM tb_item_venda where iv_status = 1 ";

    $retorno = mysqli_query($link, $sql);
    #SE CARRINHO NÃO EXISTE CRIA UM NOVO CARRINHO
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];

        if ($cont == 0) {
            
            // INSERINDO ITEM NA ITEM VENDA

            //CRIA O CODIGO DO ITEM_VENDA
            $codigo_itemvenda = md5(rand(1,9999) . date('h:i:s'));

            $sqlitem = "INSERT INTO tb_item_venda (iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id, iv_status)
            VALUES ($valorlista, $qtditem, '$codigo_itemvenda', $idproduto, '1')";
            //echo ($sqlitem);
            mysqli_query($link, $sqlitem);


        } else {
            #SE CARRINHO EXISTE, CONSULTA O NUMERO DO CARRINHO PARA ADICIONAR MAIS ITENS NESSE CARRINHO
            $sql = "SELECT iv_cod_iv FROM tb_item_venda where iv_status = 1";
            $carrinhoaberto = mysqli_query($link, $sql);

            $tbl = mysqli_fetch_array($carrinhoaberto) ;

                $codigo_itemvenda_ok = $tbl[0];
                    
                    $sqlitem = "INSERT INTO tb_item_venda (iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id, iv_status)
                    VALUES ($valorlista, $qtditem, '$codigo_itemvenda_ok', $idproduto, '1')";
                    mysqli_query($link, $sqlitem);

        }
    }
}


// TRAZ LISTA DE CLIENTES
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link, $sqlcli);


// TRAZ LISTA DE PRODUTOS PARA COMPRA
$sqlpro = "SELECT * FROM tb_produtos";
$retornopro = mysqli_query($link, $sqlpro);

//TRAZ LISTA DE PRODUTOS ADICIONADOS
$sqllistapro = "SELECT
pro.pro_id, pro.pro_nome, pro.pro_imagem, pro.pro_preco,
iv.iv_quantidade, iv.iv_valortotal, iv.iv_id
FROM tb_produtos pro
JOIN tb_item_venda iv ON pro.pro_id = iv.fk_pro_id 
WHERE iv.iv_status = 1;
";
$retorno = mysqli_query($link, $sqllistapro);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>VENDAS</title>
</head>

<body>
    <div class="container-global">

        <form class="formulario" action="vendas.php" method="post">

            <label>SELECIONE O PRODUTO</label>
            <select name='produto'>
                <!-- PUXANDO DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                <!-- <option value='vazio'>VAZIO</option> -->
               <?php while ($tblpro = mysqli_fetch_array($retornopro)) {
                ?>
                <!-- OPTION ABAIXO COM 3 VARIAVEIS EM UMA LISTA (SEPARADAS POR ',') -->
                <option value="<?= $tblpro[0] . ',' . $tblpro[1] . ',' . $tblpro[4] ?>"><?= strtoupper($tblpro[1]) ?></option>
                <?php
                    }
                ?>

            </select>
            <br>
            <label>QUANTIDADE</label>
            <input type='decimal' name="qtditem">

            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
    </div>

        <br>

        <div class="container-listaproduto">
            <table class="lista">
                <tr>
                    <th>ID</th>
                    <th>NOME PRODUTO</th>
                    <th>VALOR UN.</th>
                    <th>QUANTIDADE</th>
                    <th>IMAGEM</th>
                    <th>DELETAR</th>
                </tr>
                <?php
                while($tbl = mysqli_fetch_array($retorno)){
                    ?>
                <!-- PREENCHENDO O RETORNO  -->
                <tr>
                    <td><?= $tbl[0] ?></td> <!-- COLETA O ID DO PRODUTO-->
                    <td><?= $tbl[1] ?></td> <!-- COLETA O NOME DO PRODUTO-->
                    <td><?= $tbl[3] ?></td> <!-- COLETA O QTD PRODUTO-->
                    <td><?= $tbl[4] ?></td> <!-- COLETA O VALOR UN.-->
                    <td><img src='data:image/jpeg;base64,<?= $tbl[2] ?>' width="200" height="200"></td>
                    <!-- COLETA A IBAGEM -->

                    <td><a href="venda-deleta-item.php?id=<?= $tbl[6] ?>">
                            <input type="button" value="EXCLUIR"> <!-- TEM QUE FAZER AINDA-->
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
<br>

<!-- FORMULARIO FINAL DE ENVIO -->
    <div class="container-global">
        <form class="formulario" action="venda_finalizar.php" method="post">
            <label>CUPOM</label>
            <input type="text" id="codigo" name='codigo' placeholder="digite o codigo do cupom" maxlength="14">
            <br>
            <label>SELECIONE O CLIENTE</label>
            <select name='nomecliente'>
                <!-- PUXANDO DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                <!-- <option value='vazio'>VAZIO</option> -->
                <?php while ($tblcli = mysqli_fetch_array($retornocli)) {
                ?>
                
                <option value="<?= $tblcli[0] ?>"><?= strtoupper($tblcli[1]) ?></option>
                
                <?php

    }
    ?> </select>


<label>VALOR TOTAL</label>
    <!-- PHP PARA FAZER A SOMA  TOTAL DA VENDA -->
        <?php $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_status = 1"; 
        $retornovalortotal = mysqli_query($link, $valortotal);
        while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)) {
            echo "R$ ". $tblvalortotal[0];

        }?>

            <!-- <input type="submit" value="CONCLUIR COMPRA"> -->
            <input type="submit" value="CONFIRMAR">
                       
</form>

</body>

</html>