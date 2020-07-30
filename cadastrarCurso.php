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
    $cursoNome=$_POST['curso'];
    $cursoDescricao=$_POST['descricao'];
    $cursoCategoria=$_POST['categoria'];

    if ($cursoNome == null || $cursoDescricao == null || $cursoCategoria == null){

        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
                            Dados inválidos!</div>";

        header("Location: cadastroCurso.php");
        exit;

    }

    //Verificando se o usuário informado já existe na base de dados
    $sql = "SELECT 1 FROM cursos WHERE curso_nome = '$cursoNome'";
    $resultado = mysqli_query($conn, $sql);
    $NumRegistros = mysqli_num_rows($resultado);

    if ($NumRegistros == 0) {

        $sql = "INSERT INTO cursos(curso_nome, curso_descricao, id_categoria) VALUES('$cursoNome', '$cursoDescricao', '$cursoCategoria')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
            Curso cadastrado com sucesso!
            </div>";
    
            header("Location: cadastroCurso.php");
    
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit;
        }

    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        Curso <b>" . $cursoNome . "</b> já existe na base de dados.
        </div>";
        
        header("Location: cadastroCurso.php");
    }

    mysqli_close($conn);

?>