<?php
include("conectadb.php");
include("topo.php");

// VERIFICAR SESSION VAZIO
//session_start();

//COLETAR O VLOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT
pro.pro_id, pro.pro_nome, pro.pro_imagem, pro.pro_preco,
iv.iv_quantidade, iv.iv_valortotal, iv.iv_id, iv.iv_cod_iv
FROM tb_produtos pro
JOIN tb_item_venda iv ON pro.pro_id = iv.fk_pro_id 
WHERE iv.iv_cod_iv = '$id';
";
$retorno = mysqli_query($link, $sql);

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
    <BR>
    <div class="container-global">

        <div class="container-listaproduto">
            <table class="lista">
                <tr>
                    <th>ID</th>
                    <th>NOME PRODUTO</th>
                    <th>VALOR UN.</th>
                    <th>QUANTIDADE</th>
                    <th>IMAGEM</th>
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

            <label>VALOR TOTAL</label>
                <!-- PUXANDO DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                <!-- <option value='vazio'>VAZIO</option> -->
                <?php $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_cod_iv = '$id'";
                     $retornovalortotal = mysqli_query($link, $valortotal);
                     while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)) {
                     echo "R$ ". $tblvalortotal[0];
                }?>
        </form>
</body>
</html>