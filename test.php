<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 20/04/2018
 * Time: 14:45
 */

include ("autoloader.php");

$RequestApi = new RequestApi();


$curl = curl_init('http://localhost:3000/api/event/find?pseudoOrganizer=afavier&name=a');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$return = curl_exec($curl);
curl_close($curl);

//print_r($return);
?>
