<?php
include('conectadb.php');
include('topo.php');

//COLETAR O VLOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT * FROM tb_cupons WHERE id = '$id'";
$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $codigo = $tbl[1];
        $desconto = $tbl[2];
        $tipo_desconto = $tbl[3];
        $validade = $tbl[4];
        $usado = $tbl[5];
    }

    //BORA FAZER O UPDATE??
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $desconto = $_POST['desconto'];
        $tipo_desconto = $_POST['tipo_desconto'];
        $validade = $_POST['validade'];
        $usado = $_POST['usado'];
        $sql = "UPDATE `tb_cupons` SET `codigo`= '$codigo' ,`desconto`=$desconto,`tipo_desconto`='$tipo_desconto',`validade`='$validade',`usado`='$usado' WHERE id = $id";
        mysqli_query($link, $sql);
        echo"<script>window.alert('CUPOM ALTERADO COM SUCESSO!');</script>";
        echo"<script>window.location.href='cupom-lista.php';</script>";
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
                
    <title>ALTERAÇÃO DE CUPOM</title>
</head>
<body>
   
    <div class="container-global">
        
    <form class="formulario" action="cupom-altera.php" method="post">
        <input type="hidden" name="id" value="<?= $id?>">
        <label>CODIGO</label>
        <input type="text" id="codigo" name='codigo' placeholder="digite o codigo do cupom" value="<?= $codigo?>"maxlength="14">
        <br>
        <label>DESCONTO</label>
        <input type="desconto" name="desconto" placeholder="digite o valor" required value="<?= $desconto?>">
        <br>
        <label>TIPO</label>
        <select name='tipo_desconto'>
                <option value="porcentagem">Porcentagem</option>
                <option value="fixo">Fixo</option>
        </select>
        <br>
        <label>DATA DE VALIDADE</label>
        <input type="date" name="validade" id="validade"  value="<?= $validade?>"required>
        <br>
            <!-- SELETOR DE ATIVO E INATIVO -->
             <div class="bullets">
                <input type="radio" name="usado"  value="1" <?= $usado == '1'?"checked" : ""?>>ATIVO
                <input type="radio" name="usado" value="0"<?= $usado == '0'?"checked" : ""?>>INATIVO
             </div>
            <input type="submit" value="CONFIRMAR">
        </form>

    </div>

    <script src="scripts/script.js"></script>
    
</body>
</html>