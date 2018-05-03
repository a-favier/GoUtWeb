<?php
include ("../autoloader.php");

$me = new User();
$me->fillUserConnect($_POST['pseudo'], $_POST['pass']);

session_start();
session_unset();

if(is_null($me->getAuthToken())){
    $_SESSION['status'] = 'alert';
    $_SESSION['info'] = $me->getApiReturn()->getMessage();
    header("Location: ../index.php");
}else{
    $_SESSION['me'] = $me;
    header("Location: ../pages/accueil.php");
}