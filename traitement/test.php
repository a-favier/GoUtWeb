<?php
include("../autoloader.php");



$event = new Event();
$event->fillEventById(1);

echo $event->getDateEnd();


?>
