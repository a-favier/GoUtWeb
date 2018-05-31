<?php

include ("../autoloader.php");
session_start();

$me = $_SESSION['me'];

switch ($_POST['action']){
    case 'namesPut' :
        if($_POST['firstName'] ==  '' || $_POST['lastName'] ==  '' )
            msgRedirect("Vous devez saisir vos nouveau nom et prénom", "alert-danger");
        else
            apiRedirect($me->setNames($_POST['firstName'], $_POST['lastName'] , $_SESSION['me']->getAuthToken()));
        break;

    case 'pseudoPut' :
        if($_POST['pseudo'] ==  '')
            msgRedirect("Vous devez saisir votre nouveau pseudo", "alert-danger");
        else
            apiRedirect($me->setPseudo($_POST['firstName'] , $_SESSION['me']->getAuthToken()));
        break;

    case 'mailPut' :
        if($_POST['mail'] ==  '')
            msgRedirect("Vous devez saisir votre nouveau mail", "alert-danger");
        else
            apiRedirect($me->setMail($_POST['mail'] , $_SESSION['me']->getAuthToken()));
        break;

    case 'bornPut' :
        if($_POST['dateBorn'] ==  '')
            msgRedirect("Vous devez saisir votre nouvelle date de naissance", "alert-danger");
        else
            apiRedirect($me->setDateBorn($_POST['dateBorn'] , $_SESSION['me']->getAuthToken()));
        break;

    case 'passwordPut' :
        if($_POST['password'] ==  '')
            msgRedirect("Vous devez saisir votre nouveau mot de passe", "alert-danger");
        else
            apiRedirect($me->setPassword($_POST['password'] , $_SESSION['me']->getAuthToken()));
        break;

    case 'telPut' :
        if($_POST['tel'] ==  '')
            msgRedirect("Vous devez saisir votre nouvelle date de naissance", "alert-danger");
        else
            apiRedirect($me->setTel($_POST['tel'] , $_SESSION['me']->getAuthToken()));
        break;

    default :
        msgRedirect("Action impossible", "alert-danger");
}

function apiRedirect($apiReturn){
    if($apiReturn->isSucess()){
        $_SESSION['message'] = $apiReturn->getJsonList()[0]['message'];
        $_SESSION['messageType'] = "alert-success";
        header("Location: ../pages/settings.php");
    }else{
        $_SESSION['message'] = "Erreur : " . $apiReturn->getHtppCode() . " => " . $apiReturn->getMessage();
        $_SESSION['messageType'] = "alert-danger";
        header("Location: ../pages/settings.php");
    }
}

function msgRedirect($message, $type){
    $_SESSION['message'] = $message;
    $_SESSION['messageType'] = $type;
    header("Location: ../pages/settings.php");
}
