<?php
include ("../autoloader.php");
session_start();

$event = new Event();
$event->createEvent($_SESSION["me"], $_POST['name'], $_POST['description'], $_POST['dateStart'], $_POST['dateEnd'], $_POST['country'], $_POST['city'], $_POST['cp'], $_POST['adresse'], $_POST['booking'], 1);

$idEvent = $event->getApiReturn()->getJsonList()[0]['id'];

header("Location: ../pages/event.php?id=$idEvent");