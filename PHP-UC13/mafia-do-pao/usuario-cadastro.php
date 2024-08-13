<?php
include("conectadb.php");
include('topo.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['txtlogin'];
    $senha = $_POST['txtsenha'];
    $email = $_POST['txtemail'];

    // VALIDA SE USUARIO A CADASTRAR EXISTE
    $sql = "SELECT COUNT(usu_id) FROM tb_usuarios
    WHERE usu_login = '$login' OR usu_email = '$email' ";
    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    // VERIFICA SE NATAN EXISTE
    if($contagem == 0){
        $sql = "INSERT INTO tb_usuarios(usu_login, usu_senha, usu_email, usu_status)
        VALUES ('$login', '$senha', '$email', '1')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('USUARIO CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='login.php';</script>";
    }
    else if($contagem >= 1){
        echo"<script>window.alert('USUARIO JÁ EXISTENTE');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>CADASTRO DE USUARIO</title>
</head>
<body>

    <div class="container-global">
        
        <form class="formulario" action="usuario-cadastro.php" method="post">

            <label>LOGIN</label>
            <input type="text" name="txtlogin" placeholder="Digite seu login" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" placeholder="Digite sua senha" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
         
            <br>
            <input type="submit" value="CRIAR">
        </form>

    </div>
    
</body>
</html>