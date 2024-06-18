<?php
$n1 = 5;
$n2 = 5;
$n3 = 6;

$media = ($n1 + $n2 + $n3) /3;

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