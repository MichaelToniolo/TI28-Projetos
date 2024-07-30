<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];

// include ("header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>HOME PRINCIPAL</title>
</head>
<body>
    <div class="container-home">
    <!-- TOPO SEM MOBILE -->
        <div class="topo">
            <?php
                if ($nomeusuario != null) {
                ?>
              <label>BEM VINDO <?= strtoupper($nomeusuario)?></label>
            <?php
                }
                else {
                    echo"<script>window.alert('USUARIO NÃO LOGADO');window.location.href='login.php';</script>";
                }
            ?>
            <a href="logout.php"><img src='icons/Exit-02-WF-256.png'width="50" height="50"></a>
        </div>
  
        <!-- BOTÕES DE MENU -->
         <div class="menu">
            <a href="usuario-cadastro.php"><span class="tooltiptext">Cadastro de Usuario</span>
                                            <img src="./icons/user-add.png"></a>
            <a href="usuario-lista.php"><span class="tooltiptext">Listar Usuarios</span>
                                            <img src="icons/user-find.png"></a>
            <a href="produto-cadastro.php"><span class="tooltiptext">Cadastro Produto</span>
                                            <img src="icons/box.png"></a></a>
            <a href="produto-lista.php"><span class="tooltiptext">Listar Produto</span>
                                            <img src="icons/gantt.png"></a>
            <a href="cliente-cadastro.php"><span class="tooltiptext">Cadastrar Cliente</span>
                                            <img src="icons/customer.png"></a>
            <a href="cliente-lista.php"><span class="tooltiptext">Listar Cliente</span>
                                            <img src="icons/people.png"></a></a>
            <a href="vendas.php"><span class="tooltiptext">Vendas</span>
                                            <img src="icons/shopping-cart-02.png"></a>
        
         </div>
    </div>
    
</body>
</html>