<?php
include ("../autoloader.php");
session_start();

$event = new Event();
$result = $event->createEvent($_SESSION["me"], $_POST['name'], $_POST['description'], $_POST['dateStart'], $_POST['dateEnd'], $_POST['country'], $_POST['city'], $_POST['cp'], $_POST['adresse'], $_POST['booking'], 1);

if($result->isSucess()){
    $idEvent = $result->getJsonList()[0]['id'];

    $_SESSION['message'] = "Votre événement a été crée ! Vous pouvez y ajouter des catégorie, prix et clientele. Ainsi que le modifier...";
    $_SESSION['messageType'] = "alert-success";
    header("Location: ../pages/settings.php");
    header("Location: ../pages/event.php?id=$idEvent");
}else{
    $_SESSION['message'] = "Erreur n°" . $result->getHtppCode() . " : L'événement n'a pas put étre crée";
    $_SESSION['messageType'] = "alert-danger";
    header("Location: ../pages/settings.php");
    header("Location: ../pages/accueil.php");
}
