<?php

// $n1 = 10;
// $n2 = 5;
// $n3 = 6;

// USANDO METODO GET PARA COLETA DE NOTAS
// PARA COLETAR DADOS USANDO METODO GET 
// [seuscript.php?suavariavel=seuvalor&outravariavel=outrovalor]
$n1 = $_GET['n1'];
$n2 = $_GET['n2'];
$n3 = $_GET['n3'];
$nome = $_GET['nome'];


$media = ($n1 + $n2 + $n3) /3;
echo("Nome do aluno: ". $nome);
echo("<br>");
echo("Nota 1: ". $n1);
echo("<br>Nota 2: ". $n2);
echo("<br>Nota 3: ". $n3);
echo("<br>Média: ". $media);
echo("<br>");
if($media >= 7){
    echo($media);
    echo("<br>Aluno Passou!");
}
else if($media >= 6 & $media <7){
    echo("<br>Aluno em Recuperação! NOOOOOOSSAAA!!!");
}
else if($media < 6){
    echo("<br>Aluno REPROVADO! <br>N<br>O<br>O<br>O<br>O<br>O<br>O<br>S<br>S<br>A<br>A<br>A<br>!!!");
}
?>