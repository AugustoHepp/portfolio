<?php
    include "conexao.php";
    session_start();

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                            Área restrita. Faça login! </div>";
        header("Location: login.php");
        exit;
    }

    //Recuperando dados do formulário
    $categoria=$_POST['categoria'];

    if ($categoria == null){

        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                            Dados inválidos!</div>";

        header("Location: cadastroCategoria.php");
        exit;

    }

    //Verificando se o usuário informado já existe na base de dados
    $sql = "SELECT 1 FROM categorias WHERE categoria_nome = '$categoria'";
    $resultado = mysqli_query($conn, $sql);
    $NumRegistros = mysqli_num_rows($resultado);

    if ($NumRegistros == 0) {

        $sql = "INSERT INTO categorias(categoria_nome) VALUES('$categoria')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
            Categoria cadastrada com sucesso!
            </div>";
    
            header("Location: cadastroCategoria.php");
    
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit;
        }

    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        Categoria <b>" . $categoria . "</b> já existe na base de dados.
        </div>";
        
        header("Location: cadastroCategoria.php");
    }

    mysqli_close($conn);

?>