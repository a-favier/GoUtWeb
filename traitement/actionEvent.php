<?php
include ("../autoloader.php");
session_start();

$event = new Event();
$event->fillEventById($_POST['eventId']);

switch ($_POST['action']){
    case 'categorieAdd' :
        if($_POST['categorieId'] ==  '')
            msgRedirect("Vous devez selectionner une catégorie a ajouter !", "alert-danger");
        else
            apiRedirect($event->addCategorie($_POST['categorieId'], $_SESSION['me']->getAuthToken()));
        break;

    case 'categorieDel' :
        if($_POST['categorieId'] ==  '')
            msgRedirect("Vous devez selectionner une catégorie a supprimer !", "alert-danger");
        else
            apiRedirect($event->removeCategorie($_POST['categorieId'], $_SESSION['me']->getAuthToken()));
        break;

    case 'clienteleAdd' :
        if($_POST['clienteleId'] ==  '')
            msgRedirect("Vous devez selectionner une clientèle a ajouter !", "alert-danger");
        else
            apiRedirect($event->addClientele($_POST['clienteleId'], $_SESSION['me']->getAuthToken()));
        break;

    case 'clienteleDel' :
        if($_POST['clienteleId'] ==  '')
            msgRedirect("Vous devez selectionner une clientèle a supprimer !", "alert-danger");
        else
            apiRedirect($event->removeClientele($_POST['clienteleId'], $_SESSION['me']->getAuthToken()));
        break;

    case 'tarifAdd' :
        if($_POST['libel'] ==  '' || $_POST['prix'] ==  '')
            msgRedirect("Vous devez saisir un libel et un prix", "alert-danger");
        else
            apiRedirect($event->addTarif($_POST['libel'], $_POST['prix'], $_SESSION['me']->getAuthToken()));
        break;

    case  'tarifDel' :
        if($_POST['tarifId'] ==  '')
            msgRedirect("Vous devez selectionner un tarif a supprimer !", "alert-danger");
        else
            apiRedirect($event->removeTarif($_POST['tarifId'], $_SESSION['me']->getAuthToken()));
        break;

    case 'namePut' :
        if($_POST['name'] ==  '')
            msgRedirect("Vous devez saisir le nouveau nom de l'événement", "alert-danger");
        else
            apiRedirect($event->setName($_POST['name'], $_SESSION['me']->getAuthToken()));
        break;

    case 'descriptionPut' :
        if($_POST['description'] ==  '')
            msgRedirect("Vous devez saisir la nouvelle description de l'événement", "alert-danger");
        else
            apiRedirect($event->setDescription($_POST['description'], $_SESSION['me']->getAuthToken()));
        break;

    case 'datePut' :
        if($_POST['dateStart'] ==  '' || $_POST['dateEnd'] ==  '')
            msgRedirect("Vous devez saisir les nouvelles dates de l'événement", "alert-danger");
        else
            apiRedirect($event->setDates($_POST['dateStart'], $_POST['dateEnd'], $_SESSION['me']->getAuthToken()));
        break;

    case 'placePut' :
        if($_POST['country'] ==  '' || $_POST['city'] ==  '' || $_POST['postalCode'] ==  '' || $_POST['adresse'] ==  '')
            msgRedirect("Vous devez saisir le nouveau lieu de l'événement", "alert-danger");
        else
            apiRedirect($event->setLocal($_POST['country'], $_POST['city'],  $_POST['postalCode'], $_POST['adresse'], 0.0, 0.0, $_SESSION['me']->getAuthToken()));
        break;

    case 'bookingPut' :
        if($_POST['booking'] == '')
            msgRedirect("Action impossible", "alert-danger");
        else
            apiRedirect($event->setBooking($_POST['booking'], $_SESSION['me']->getAuthToken()));
        break;

    case 'activePut' :
        if($_POST['actif'] == '')
            msgRedirect("Action impossible", "alert-danger");
        else
            apiRedirect($event->setActive($_POST['actif'], $_SESSION['me']->getAuthToken()));
        break;

    default :
        msgRedirect("Action impossible", "alert-danger");
}

function apiRedirect($apiReturn){
    if($apiReturn->isSucess()){
        $_SESSION['message'] = $apiReturn->getJsonList()[0]['message'];
        $_SESSION['messageType'] = "alert-success";
        header("Location: ../pages/event.php?id=" . $_POST['eventId']);
    }else{
        $_SESSION['message'] = "Erreur : " . $apiReturn->getHtppCode() . " => " . $apiReturn->getMessage();
        $_SESSION['messageType'] = "alert-danger";
        header("Location: ../pages/event.php?id=" . $_POST['eventId']);
    }
}

function msgRedirect($message, $type){
    $_SESSION['message'] = $message;
    $_SESSION['messageType'] = $type;
    header("Location: ../pages/event.php?id=" . $_POST['eventId']);
}
