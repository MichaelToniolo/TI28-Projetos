<?php
include("conectadb.php");
include('topo.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $codigo = $_POST['codigo'];
    $desconto = $_POST['desconto'];
    $tipo_desconto = $_POST['tipo_desconto'];
    $validade = $_POST['validade'];

    $sql = "SELECT COUNT(codigo) FROM tb_cupons WHERE codigo = '$codigo' ";

    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];


    if($contagem == 0){
        $sql = "INSERT INTO `tb_cupons`(`codigo`, `desconto`, `tipo_desconto`, `validade`, `usado`) VALUES
        ('$codigo', $desconto, '$tipo_desconto', '$validade', '1')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('CUPOM CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='backoffice.php';</script>";
    }
    else if($contagem >= 1){
        echo"<script>window.alert('CUPOM JÁ EXISTENTE');</script>";
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

    <title>CADASTRO CUPOM</title>
</head>
<body>

<div class="container-global">
    
    <form class="formulario" action="cupom-cadastro.php" method="post">
        <label>CODIGO</label>
        <input type="text" id="codigo" name='codigo' placeholder="digite o codigo do cupom" maxlength="14">
        <br>
        <label>DESCONTO</label>
        <input type="desconto" name="desconto" placeholder="digite o valor" required>
        <br>
        <label>TIPO</label>
        <select name='tipo_desconto'>
                <option value="porcentagem">Porcentagem</option>
                <option value="fixo">Fixo</option>
        </select>
        <br>
        <label>DATA DE VALIDADE</label>
        <input type="date" name="validade" id="validade"  required>
        <br>
        <input type="submit" value="CADASTRAR CUPOM">
    </form>

</div>

<script src="scripts/script.js"></script>

</body>
</html>