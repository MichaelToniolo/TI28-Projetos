<?php
include("conectadb.php");
//include("topo.php");

$idiv = $_GET['id'];
$sqldeleta = "DELETE FROM tb_item_venda WHERE iv_id = $idiv";
$resultado = mysqli_query($link, $sqldeleta);
#retorna para o carrinho
header("Location: vendas.php");
