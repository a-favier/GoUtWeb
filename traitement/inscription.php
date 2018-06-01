<?php
include ("../autoloader.php");
session_start();

$me = new User();

if(!empty($_POST['pseudo']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['mail']) && !empty($_POST['pass'])){
    $result = $me->createNewUser($_POST['pseudo'], $_POST['firstName'], $_POST['lastName'],null, $_POST['mail'],null, $_POST['pass']);
    if($result->isSucess()){
        $_SESSION['status'] = 'success';
        $_SESSION['info'] = "Inscription réussite !! Veuillez vous connecter";
        header("Location: ../index.php");
    }else{
        $_SESSION['status'] = 'danger';
        $_SESSION['info'] = $result->getMessage();
        header("Location: ../index.php");
    }
}else{
    $_SESSION['status'] = 'danger';
    $_SESSION['info'] = "Veuillez renseigner tous les champs";
    header("Location: ../index.php");
}


