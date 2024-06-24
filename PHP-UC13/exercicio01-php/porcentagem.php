<?php
$vlporcentagem = 10;
$numero = 342;
echo($vlporcentagem ."% de 342 é: ". ($vlporcentagem /100) * $numero);
echo("<br>");
echo($vlporcentagem . "% de Desconto sobre o valor de ". $numero -($numero * ($vlporcentagem /100)));
?>