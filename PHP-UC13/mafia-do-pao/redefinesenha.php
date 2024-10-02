<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('conectadb.php');
    $email = $_POST['email'];
    $cod = $_POST['cod'];
    $senha = $_POST['senha'];

    if($cod==""){ //validação se o campo cod foi digitado nulo
        header("Location:redefinesenha.php?msg=Cod invalido");
        exit();
    }

    $sql = "SELECT COUNT(usu_id) FROM tb_usuarios WHERE usu_email =
    '$email' AND recupera = '$cod'";
    //echo $sql;
    $resultado = mysqli_query($link,$sql);

    while($tbl = mysqli_fetch_array($resultado)){
        $cont = $tbl[0];
    }
    if($cont == 0){ //caso o codigo ou email estejam errados, redefine um novo codigo
        $sql ="UPDATE tb_usuarios SET recupera = '' WHERE usu_email = '$email'";
        mysqli_query($link,$sql);
        header("Location:redefinesenha.php?msg=Codigo errado, solicite outro");
        exit();
    }
    else{
        $random = rand(100000,999999);
        $tempero = md5(rand() . date('H:i:s')); //novo tempero
        $senha = md5($tempero . $senha); //criptografa a senha
        $sql = "UPDATE tb_usuarios SET usu_senha = '$senha', tempero = '$tempero',
        recupera = $random WHERE usu_email = '$email'";
        mysqli_query($link,$sql);
        header("Location:login.php?msg=Senha alterada com sucesso");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefine Senha</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfontes.com/css/curely" rel="styleshhet">
</head>
<body>
    <div class ="container-global">
        <form class="formulario" action="redefinesenha.php" method="POST">
            <h1>REDEFINIR SENHA</h1>
            <label>EMAIL</label>
            <input type="text" name="email" id="email" required>
            <br>
            <label>CODIGO</label>
            <input type="text" name="cod" id="cod" required>
            <br>
            <label>NOVA SENHA</label>
            <input type="password" id="senha" name="senha" required>
            <br>
            <input type="submit" name="login" value="REDEFINIR">
        </form>

        <p id="msg">
            <?php
            if(isset($_GET['msg'])){
                echo($_GET['msg']);
                if($_GET['msg'] == "Usuario ou senha incorretos"){
                    echo("<br><a href='recuperasenha.php'>Esqueci minha senha</a>");
                }
            }
            ?>
        </p>
    </div>
</body>
</html>