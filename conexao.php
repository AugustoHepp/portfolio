<?php
    //Desabilitando warnings
    error_reporting(E_ALL ^ E_WARNING);
    
    //Definindo parametros de conexão com o banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bancodedados = "cadastro";

    $conn = mysqli_connect($servidor, $usuario, $senha, $bancodedados);

    //Verificando conexão
    if (!$conn) {
        if (mysqli_connect_errno() == 1049){
            echo "O banco de dados: <b>" . $bancodedados . "</b> não foi encontrado.";
            exit;
        } else {
            echo "Erro de conexão com o banco de dados: " . mysqli_connect_error() . " " . mysqli_connect_errno();
            exit;
        }
    }
?>