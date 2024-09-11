<?php
include("conectadb.php");
include("topo.php");

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
                <tr>
                    <td><?= $tbl[0] ?></td> 
                    <td><?= $tbl[1] ?></td>
                    <td><?= $tbl[3] ?></td> 
                    <td><?= $tbl[4] ?></td> 
                    <td><img src='data:image/jpeg;base64,<?= $tbl[2] ?>' width="200" height="200"></td>  
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <br>
    <div class="container-global">
        <form class="formulario" action="venda_finalizar.php" method="post">
            <label>VALOR TOTAL</label>
                <?php $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_cod_iv = '$id'";
                     $retornovalortotal = mysqli_query($link, $valortotal);
                     while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)) {
                     echo "R$ ". $tblvalortotal[0];
                }?>
        </form>
</body>
</html>