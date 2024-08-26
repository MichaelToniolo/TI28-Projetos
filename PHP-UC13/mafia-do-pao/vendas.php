<?php
include("conectadb.php");
include("topo.php");

// VERIFICAR SESSION VAZIO
session_start();

// APÓS O CLIQUE DE ADD FAÇA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomecliente = $_SESSION['nomecliente'];
    $nomeproduto = $_SESSION['nomeproduto'];
    $idproduto = $_SESSION['idproduto'];
    $idcliente = $_SESSION['idcliente'];
    $valorproduto = $_SESSION['valorproduto'];

    $qtditem = $_POST['qtditem'];

    $codigo_itemvenda = md5($idcliente . date('h:i:s'));
    //CALCULANDO VALOR ITENS
    $valorlista = $valorproduto * $_POST['qtditem'];

    // INSERINDO ITEM NA ITEM VENDA
    $sqlitem = "INSERT INTO tb_item_venda (iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id)
    VALUES ($valorlista, $qtditem, '$codigo_itemvenda', $idproduto)";
    echo($sqlitem);
    mysqli_query($link, $sqlitem);
}


// TRAZ LISTA DE CLIENTES
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link, $sqlcli);


// TRAZ LISTA DE PRODUTOS PARA COMPRA
$sqlpro = "SELECT * FROM tb_produtos";
$retornopro = mysqli_query($link, $sqlpro);

//TRAZ LISTA DE PRODUTOS ADICIONADOS
// POOOTZ MANO..........AJEITAR O INNER JOIN
$sqllistapro = "SELECT * FROM tb_item_venda INNER JOIN tb_produtos ON fk_pro_id = pro_id";
$retorno = mysqli_query($link, $sqllistapro);
while ($tbl = mysqli_fetch_array($retorno)) {
    $nomeproduto = $tbl[4];
    $valorproduto = $tbl[4];
}
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
    <<div class="container-global">

        <form class="formulario" action="vendas.php" method="post">

            <label>SELECIONE O CLIENTE</label>
            <select name='nomecliente'>
                <!-- PUXANDO DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                <?php while ($tblcli = mysqli_fetch_array($retornocli)) {
                ?>
                    <option value='vazio'>VAZIO</option>
                    <option value="<?= $tblcli[1] ?>"><?= strtoupper($tblcli[1]) ?></option>

                <?php

                    $_SESSION['nomecliente'] = $tblcli[1];
                }

                ?>
            </select>
            <br>

            <label>SELECIONE O PRODUTO</label>
            <select name='nomeproduto'>
                <!-- PUXANDO DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                <?php while ($tblpro = mysqli_fetch_array($retornopro)) {
                ?>
                    <option value='vazio'>VAZIO</option>
                    <option value="<?= $tblpro[1] ?>"><?= strtoupper($tblpro[1]) ?></option>

                <?php
                    $_SESSION['idproduto'] = $tblpro[0];
                    $_SESSION['nomeproduto'] = $tblpro[1];
                    $_SESSION['valorproduto'] = $tblpro[4];
                }

                ?>
            </select>
            <br>
            <label>QUANTIDADE</label>
            <input type='decimal' name="qtditem">

            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
        <br>
        <div class="container-listaproduto">
            <table class="lista">
                <tr>
                    <th>ID</th>
                    <th>NOME PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR UN.</th>
                    <th>DELETAR</th>
                </tr>

                <!-- PREENCHENDO O RETORNO  -->
                <tr>
                    <td><?=$tbl[1]?></td> <!-- COLETA O NOME DO PRODUTO-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O QTD PRODUTO-->
         
                    <td><?=$tbl[5] == '1'?"ATIVO":"INATIVO" ?></td> <!-- COLETA O STATUS DO PRODUTO-->
                    <td><img src='data:image/jpeg;base64,<?= $tbl[6]?>' width="200" height="200"></td> <!-- COLETA A IBAGEM -->
                    
                    <td><a href="produto-altera.php?id=<?=$tbl[0]?>">
                            <input type="button" value="ALTERAR">
                        </a>
                    </td>
                 </tr>
                
            </table>
        </div>
        </div>

</body>

</html>