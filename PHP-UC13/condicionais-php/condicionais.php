<?php
//CONDICIONAIS SIMPLES EM PHP
$numero1 = 23;
$numero2 = 22;
echo("Numero 1: ". $numero1);
echo("<br>");
echo("Numero 2: ". $numero2);
echo("<br>");

if($numero1 === $numero2){
    echo("É igual");
}
else{
    echo("É diferente");
}

// OPERADOR TERNÁRIO
$numero1 >= $numero2?print("Maior"):print("Menor");


?>