<?php
include('conectadb.php');
include('topo.php');

//COLETAR O VLOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cpf = $tbl[1];
        $nome = $tbl[2];
        $email = $tbl[3];
        $cel = $tbl[4];
        $status = $tbl[5];
    }

    //BORA FAZER O UPDATE??
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $cpf = $_POST['cpf'];
        $nome = $_POST['txtnome'];
        $email = $_POST['txtemail'];
        $cel = $_POST['txtcel'];
        $status = $_POST['status'];

        $sql = "UPDATE tb_clientes SET cli_nome = '$nome', cli_email = '$email', cli_cel = '$cel', cli_status = '$status' WHERE cli_id = $id";
        mysqli_query($link, $sql);
        echo"<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
        echo"<script>window.location.href='cliente-lista.php';</script>";
        exit();

    }


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>ALTERAÇÃO DE CLIENTE</title>
</head>
<body>
   
    <div class="container-global">
        
        <form class="formulario" action="cliente-altera.php" method="post">
            <input type="hidden" name="id" value="<?= $id?>">
            <label>CPF</label>
            <input type="text" id="cpf" name='txtcpf' placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)" value="<?= $cpf?>" disabled>
            <br>
            <label>NOME</label>
            <input type="txtnome" name="txtnome" placeholder="digite seu nome" value="<?= $nome?>" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" value="<?= $email?>" placeholder="Digite seu email" required>
            <br>
            <label>TELEFONE</label>
            <input type="text" name="txtcel" id="telefone" placeholder="(00) 00000-0000" maxlength="15"  value="<?= $cel?>" required>
            <br>

            <!-- SELETOR DE ATIVO E INATIVO -->
             <div class="bullets">
                <input type="radio" name="status"  value="1" <?= $status == '1'?"checked" : ""?>>ATIVO
                <input type="radio" name="status" value="0"<?= $status == '0'?"checked" : ""?>>INATIVO
             </div>
            <br>
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>

    </div>

    <script src="scripts/script.js"></script>
    
</body>
</html>