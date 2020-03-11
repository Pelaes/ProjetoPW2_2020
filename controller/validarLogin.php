<?php  
    session_start();

    if(empty($_POST)){
        header("Location: ../");
        die();
    }

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if(empty($user)){
        //echo "ErroEmail";
        echo "Digite seu Email ou nome de usuário!";
        die();
    }
    if(empty($pass)){
        echo "Digite sua senha!";
        //echo "ErroSenha";
        die();
    }

    include_once '../model/login.php';
?>