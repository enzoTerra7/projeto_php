<?php
$servidor='localhost';
$usuario='root';
$senha='';
$db='website';

$conexao=mysqli_connect($servidor,$usuario,$senha,$db);
if (!$conexao) {
    print("ERRO NA CONEXÃO COM MYSQL");
    print("ERRO: ".mysqli_connect_error());
    exit;
}

?>