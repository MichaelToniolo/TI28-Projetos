<?php
include("conectadb.php");
include("topo.php");

// TRAZ LISTA DE CLIENTES
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link, $sqlcli);


// // TRAZ LISTA DE PRODUTOS
// $sqlcli = "SELECT * FROM tb_produtos";
// $retornopro = mysqli_query($link, $sqlpro);
// ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENDAS</title>
</head>
<body>
    <<div class="container-global">
        
        <form class="formulario" action="vendas.php" method="post">

                    <label>SELECIONE O CLIENTE</label>
                    <select>
                        <!-- PUXANDO DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                            <?php while($tblcli = mysqli_fetch_array($retornocli)){
                                ?>
                                <option value="idproduto"><?= strtoupper($tblcli[1])?></option>
                            <?php
                            }
                       ?>
                    </select>
                
                    <br>
                    <input type="submit" value="CONFIRMAR">
            </form>
    
        </div>
    
</body>
</html>