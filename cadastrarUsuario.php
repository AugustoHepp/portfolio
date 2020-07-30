<?php
    include "conexao.php";
    session_start();
    
    //Recuperando dados do formulário
    $senha=$_POST['senha'];
    $email=$_POST['email'];

    if ($senha == null || $email == null){

        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                            Usuário ou senha inválidos!</div>";

        header("Location: login.php");
        exit;

    }

    if (!mysqli_query($conn, $sql)) {
        echo "Erro ao criar a tabela de usuários" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn);
        exit;
    }

    //Verificando se o usuário informado já existe na base de dados
    $sql = "SELECT 1 FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $sql);
    $NumRegistros = mysqli_num_rows($resultado);

    if ($NumRegistros == 0) {

        $senhaCripto = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO USUARIOS(email, senha) VALUES('$email', '$senhaCripto')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
            Usuário cadastrado com sucesso!
            </div>";

            header("Location: login.php");

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit;
        }

    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        Usuário <b>" . $email . "</b> já existe na base de dados.
        </div>";
        
        header("Location: cadastroUsuario.php");
    }

    mysqli_close($conn);

?>