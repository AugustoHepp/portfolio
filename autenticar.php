<?php
    include "conexao.php";
    session_start();
    
    //Recuperando dados do formulário
    $email=$_POST['email'];
    $senha=$_POST['senha'];

    if ($email == null || $senha == null){

        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                            Dados inválidos!</div>";

        header("Location: login.php");
        exit;

    }

    //Validando usuário
    $sql = "SELECT id_usuario, email, senha FROM usuarios WHERE email = '$email' LIMIT 1";
    $resultado = mysqli_query($conn, $sql);
    $NumRegistros = mysqli_num_rows($resultado);

    if ($NumRegistros > 0) {
        $rowUsuario = mysqli_fetch_assoc($resultado);

        if (password_verify($senha, $rowUsuario['senha'])){
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['senha'] = $_POST['senha'];
            header("Location: busca.php");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                                Senha incorreta</div>";
            header("Location: login.php");
        }
        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                            Usuário não encontrado</div>";
        header("Location: login.php");
    }

    mysqli_close($conn);

?>


    