<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LOGIN USUARIO</title>
</head>
<body>
    <div class="container-global">
        <form class="formulario" action="login.php" method="post">
            <label>LOGIN</label>
            <input type="text" name="txtlogin" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" required>
            <br>
            <br>
            <input type="submit" value="ACESSAR">
        </form>

    </div>
    
</body>
</html>