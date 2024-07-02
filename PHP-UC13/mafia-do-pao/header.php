<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!-- Simulate a smartphone / tablet -->
<div class="mobile-container">

        <!-- TOPO SEM MOBILE -->
        <div class="topo">
            <label>Bem Vindo</label>
            <a href="logout.php">Sair</a>
        </div>

<!-- Topo Mobile-->
<div class="topnav">
<a href="home.php"><img src="icons/arrowhead-left-01.png" width="16" height="16"></a>

  <div id="myLinks">
            <a href="usuario-cadastro.php">CADASTRAR USUARIOS</a>
            <a href="usuario-lista.php">LISTAR USUARIOS</a>
            <a href="produto-cadastro.php">CADASTRAR PRODUTO</a>
            <a href="produto-lista.php">LISTAR PRODUTO</a>
            <a href="cliente-cadastro.php">CADASTRAR CLIENTE</a>
            <a href="cliente-lista.php">LISTAR CLIENTE</a>
            <a href="vendas.php">VENDAS</a>
  </div>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>

</body>
</html>
