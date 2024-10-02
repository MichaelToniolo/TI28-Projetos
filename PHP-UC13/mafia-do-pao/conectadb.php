<?php
// LOCALIZA ONDE ESTÁ O BANCO DE DADOS
$servidor = "localhost";

// NOME DO BANCO
$banco = "mafia";

// QUAL USUARIO VAI OPERAR NA BASE DE DADOS
$usuario = "root";

// QUAL A SENHA DO USUARIO NA BASE DE DADOS
$senha = "";

// LINK QUE A FERRAMENTA VAI USAR PARA CONECTAR NO BANCO
$link = mysqli_connect($servidor, $usuario, $senha, $banco);

//DEFINE HORARIO PARA O MESMO DE SP
date_default_timezone_set('America/Sao_Paulo');
