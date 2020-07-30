<?php
    session_start();

    unset($_SESSION['email'], $_SESSION['senha']);

    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
            Deslogado com sucesso</div>";
    header("Location: login.php");
?>