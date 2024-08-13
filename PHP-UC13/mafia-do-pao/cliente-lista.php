<?php
include('conectadb.php');
include('topo.php');

// CONSULTA USUARIOS CADASTRADOS
$sql = "SELECT *  FROM tb_clientes WHERE cli_status = '1'";
$retorno = mysqli_query($link, $sql);
$status = '1';


// ENVIANDO PARA O SERVIDOR O SELETOR RADIO EM 0 OU 1
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM tb_clientes WHERE cli_status = '0'";
        $retorno = mysqli_query($link, $sql);
    }
}

?> 


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    
    <title>CLIENTE LISTA</title>
</head>
<body>
   
    <div class="container-listacliente">
       <!-- LISTAR ATIVOS E INATIVOS -->
            <form action="cliente-lista.php" method="post">
                <input type="radio" name="status" value="1" required onclick="submit()"
                <?= $status=='1' ? "checked":""?>>ATIVOS
                <br>
                <input type="radio" name="status" value="0" required onclick="submit()"
                <?= $status=='0' ? "checked":""?>>INATIVOS
                <br>
            </form>
        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">
            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>STATUS</th>
                <th>ALTERA</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?=$tbl[1]?></td> <!-- COLETA O CPF DO USUARIO-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O NOME DO USUARIO-->
                    <td><?=$tbl[3]?></td> <!-- COLETA O EMAIL DO USUARIO-->
                    <td><?=$tbl[4]?></td> <!-- COLETA O TELEFONE DO USUARIO-->
                    <td><?=$tbl[5] == '1'?"ATIVO":"INATIVO" ?></td> <!-- COLETA O STATUS DO USUARIO-->
                    
                    <td><a href="cliente-altera.php?id=<?=$tbl[0]?>">
                            <input type="button" value="ALTERAR">
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