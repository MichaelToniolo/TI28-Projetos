<?php
include("conectadb.php");
include("topo.php");
#PESQUISA DA VENDA GERAL

#PESQUISA A DATA MINIMA E MAXIMA PARA OS FILTROS

$selectdatamin = "SELECT MIN(ven_datavenda) FROM tb_venda";
$selectdatamax = "SELECT MAX(ven_datavenda) FROM tb_venda";

$resultado_data_min = mysqli_query($link,$selectdatamin);
$resultado_data_max = mysqli_query($link,$selectdatamax);

$data_min = mysqli_fetch_array($resultado_data_min);
$data_max = mysqli_fetch_array($resultado_data_max);

//CONFIGURANDO A DAA PARA QUE O HTML MOSTRE BONITINHO

$data_min_string = date("Y-m-d", strtotime($data_min[0]));
$data_max_string = date("Y-m-d", strtotime($data_max[0]));

#PESQUISA OS CLIENTES PARA O FILTRO
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link,$sqlcli);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idcliente = $_POST['idcliente'];
    $datainicial = $_POST['datainicial'];
    $datafinal = $_POST['datafinal'];

    if ($datainicial < 0){
    $datainicial = $data_min_string;
    }
    if ($datafinal < 0 ){
    $datafinal = $data_max_string;
    }
    $sql = "SELECT 
        v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv, v.fk_cli_id, v.fk_usu_id,
        c.cli_nome, u.usu_login
    FROM 
        tb_venda v
    JOIN 
        tb_clientes c ON v.fk_cli_id = c.cli_id
    JOIN 
        tb_usuarios u ON v.fk_usu_id = u.usu_id
    WHERE
        v.ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59' ";
 //$retorno = mysqli_query($link, $sql. "ORDER BY v.ven_id");

 $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda
                WHERE
                ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59' "; 

    if ($idcliente == 'todos' ){
        $retorno = mysqli_query($link, $sql. "ORDER BY v.ven_id");
        $retornovalortotal = mysqli_query($link, $valortotal. "ORDER BY ven_id" ); //tirar o v. de v.ven_id
    }else{
        //ADICIONAR AO '$sql' A CONDIÇÃO DE PESQUISA AO NOME
        $sql .= " AND c.cli_id = ". $idcliente . " ORDER BY ven_id";
        $retorno = mysqli_query($link,$sql);
        //errinho abaixo
        $valortotal .=  " AND fk_cli_id = ". $idcliente . " ORDER BY ven_id";
        $retornovalortotal = mysqli_query($link,$valortotal);

    }
}else{
    $sql = "SELECT 
        v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv, v.fk_cli_id, v.fk_usu_id,
        c.cli_nome, u.usu_login
    FROM 
        tb_venda v
    JOIN 
        tb_clientes c ON v.fk_cli_id = c.cli_id
    JOIN 
        tb_usuarios u ON v.fk_usu_id = u.usu_id";
    $retorno = mysqli_query($link, $sql. " ORDER BY v.ven_id");
   // echo $sql. "ORDER BY v.ven_id";
    $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda";
    $retornovalortotal = mysqli_query($link, $valortotal);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">

    <title>VENDA LISTA</title>
</head>

<body>
    <div class="container-global">
        <form class="formulario" action="venda-lista.php" method = "post">
            <label> VALOR TOTAL BRUTO </label>
            <!-- PHP PARA RETORNAR A SOMA DO VALOR TOTAL -->
             <?php 
             while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)){
                echo "R$ ". $tblvalortotal[0];
             }?>
             <br><br>
             <label> FILTROS </label> 
             <br>
             <!-- FILTRO DE DATA MINIMA E MAXIMA -->
             <label for="data"> SELECIONE A DATA INICIAL:</label>
             <input id="datainicial" name="datainicial"
             min="<?=$data_min_string?>" max="<?=$data_max_string?>" type="date">
             <label for="data"> SELECIONE A DATA FINAL:</label>
             <input id="datafinal" name="datafinal"
             min="<?=$data_min_string?>" max="<?=$data_max_string?>" type="date">

             <!-- FILTRO PARA PESQUISA DE CLIENTE -->
             <label>SELECIONE O CLIENTE:</label>
             <select name='idcliente'>
                <option value='todos'>TODOS</option> 
                <?php WHILE ($tblcli = mysqli_fetch_array($retornocli)){
                    ?>
                    <option value="<?= $tblcli[0]?>"><?=strtoupper($tblcli[1])?></option>
               <?php    
                } ?>
             </select>
                <br>
                <input type="submit" value="PESQUISAR">
        </form>
    </div>
<br>
    <!-- LISTAR A TABELA DE PRODUTOS -->
    <div class="container-listaproduto">
        <table class="lista">
            <tr>
                <th>ID</th>
                <th>DATA e HORA</th>
                <th>VALOR</th>
                <th>CLIENTE</th>
                <th>VENDEDOR</th>
                <th>VISUALIZAR</th>
            </tr>

            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
            <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
            <tr>
                <td><?=$tbl[0]?></td> <!-- COLETA O ID-->
                <?php $data_formatada = date("d/m/Y h:i", strtotime($tbl[1]));?>
                <!-- FORMATA A DATA PARA FORMATO PT.BR-->
                <td><?=$data_formatada?></td> <!-- COLETA A DATA-->
                <td>R$: <?=$tbl[2]?></td> <!-- COLETA O TOTAL -->
                <td><?=$tbl[6]?></td> <!-- COLETA O CLIENTE -->
                <td><?=$tbl[7]?></td> <!-- COLETA O USUARIO -->

                <td><a href="venda-visualizar.php?id=<?=$tbl[3]?>">
                        <input type="button" value="VISUALIZAR">
                    </a>
                </td>
            </tr>
            <?php
                }
                ?>
        </table>

    </div>

</body>

</html>