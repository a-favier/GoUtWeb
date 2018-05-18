<?php
include("../autoloader.php");

$afavier = new User();
$afavier->fillUserConnect('afavier', 's');

var_dump($afavier);


var_dump($afavier->putNames("Moniseur", "koro"));


?>
