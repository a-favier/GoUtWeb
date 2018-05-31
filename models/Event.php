<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 20/04/2018
 * Time: 14:44
 */

class Event extends RequestApi
{
    private $name, $description, $dateStart, $dateEnd, $country, $city, $postalCode, $adresse, $booking, $active, $id;
    private $listClientele, $listTarif, $listCategorie;

    private $apiReturn;

    public function __construct()
    {
        parent::__construct();
        $this->listCategorie = array();
        $this->listTarif = array();
        $this->listClientele = array();
    }

    private function dateToSql($date){
        return $date . ":00.000";
    }

    private function dateToHuman($date){
        $explodeDate = self::multiexplode(array("-","T","."),$date);
        $date = $explodeDate[2] . "-" . $explodeDate[1] . "-" . $explodeDate[0] . " " . $explodeDate[3];
        return $date;
    }

    private function multiexplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }

    public function createEvent($user, $name, $description, $dateStart, $dateEnd, $country, $city, $postalCode, $adresse, $booking, $active){
        $body = array();

        if(!is_null($name)) array_push($body,"name=".$name);
        if(!is_null($description)) array_push($body,"description=".$description);
        if(!is_null($dateStart)){
            $dateStart = self::dateToSql($dateStart);
            array_push($body,"dateStart=".$dateStart);
        }
        if(!is_null($dateEnd)) {
            $dateEnd = self::dateToSql($dateEnd);
            array_push($body,"dateEnd=".$dateEnd);
        }
        if(!is_null($country)) array_push($body,"country=".$country);
        if(!is_null($city)) array_push($body,"city=".$city);
        if(!is_null($postalCode)) array_push($body, "postalCode=".$postalCode);
        if(!is_null($adresse)) array_push($body, "adresse=".$adresse);
        if(!is_null($booking)) array_push($body, "booking=".$booking);
        if(!is_null($active)) array_push($body, "active=".$active);

        $apiReturn =  parent::sendRequest('event/user/' . $user->getPseudo(), methodType::POST, $user->getAuthToken(), $body, null);
        $this->apiReturn = $apiReturn;
        return $apiReturn;
    }

    public function fillEventById($idEvent){
        $apiReturn =  parent::sendRequest('event/event/' . $idEvent, methodType::GET, null, null, null);
        $this->apiReturn = $apiReturn;
        if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
            self::fillEventByJson($apiReturn->getJsonList()[0]);
        }
    }

    public function fillEventByJson($result){
        if(isset($result['name'])) $this->name = $result['name'];
        if(isset($result['description'])) $this->description = $result['description'];
        if(isset($result['dateStart'])) $this->dateStart = $result['dateStart'];
        if(isset($result['dateEnd'])) $this->dateEnd = $result['dateEnd'];
        if(isset($result['country'])) $this->country = $result['country'];
        if(isset($result['city'])) $this->city = $result['city'];
        if(isset($result['postalCode'])) $this->postalCode = $result['postalCode'];
        if(isset($result['adresse'])) $this->adresse = $result['adresse'];
        if(isset($result['booking'])) $this->booking = $result['booking'];
        if(isset($result['active'])) $this->active = $result['active'];
        if(isset($result['id'])) $this->id = $result['id'];
    }

    public function fillCategorie(){
        $apiReturn =  parent::sendRequest('categorie/event/' . $this->getId(), methodType::GET,null, null, null);
        if($apiReturn->isSucess()){
            foreach ($apiReturn->getJsonList() as $c){
                $categorie = new Categorie($c['id'], $c['name']);
                array_push($this->listCategorie, $categorie);
            }
        }else{
            array_push($this->listCategorie, $apiReturn->getMessage());
        }
    }

    public function getListCategorie()
    {
        return $this->listCategorie;
    }

    public function addCategorie($id, $token){
        $body = array("idCategorie=".$id);

        return $apiReturn =  parent::sendRequest('categorie/event/' . $this->getId(), methodType::POST, $token, $body, null);
    }

    public function removeCategorie($id, $token){
        $body = array("idCategorie=".$id);

        return $apiReturn =  parent::sendRequest('categorie/event/' . $this->getId(), methodType::DELETE, $token, $body, null);
    }

    public function fillClientele(){
        $apiReturn =  parent::sendRequest('clientele/event/' . $this->getId(), methodType::GET,null, null, null);
        if($apiReturn->isSucess()){
            foreach ($apiReturn->getJsonList() as $c){
                $clientele = new Clientele($c['id'], $c['name']);
                array_push($this->listClientele, $clientele);
            }
        }else{
            array_push($this->listClientele, $apiReturn->getMessage());
        }
    }

    public function getListClientele()
    {
        return $this->listClientele;
    }

    public function addClientele($id, $token){
        $body = array("idClientele=".$id);

        return $apiReturn =  parent::sendRequest('clientele/event/' . $this->getId(), methodType::POST, $token, $body, null);
    }

    public function removeClientele($id, $token){
        $body = array("idClientele=".$id);

        return $apiReturn =  parent::sendRequest('clientele/event/' . $this->getId(), methodType::DELETE, $token, $body, null);
    }

    public function fillTarif(){
        $apiReturn =  parent::sendRequest('tarif/event/' . $this->getId(), methodType::GET,null, null, null);
        if($apiReturn->isSucess()){
            foreach ($apiReturn->getJsonList() as $t){
                $tarif = new Tarif($t['id'], $t['name'], $t['price']);
                array_push($this->listTarif, $tarif);
            }
        }else{
            array_push($this->listTarif, $apiReturn->getMessage());
        }
    }

    public function getListTarif()
    {
        return $this->listTarif;
    }

    public function addTarif($name, $price, $token){
        $body = array();
        array_push($body, "name=".$name);
        array_push($body, "price=".$price);
        return parent::sendRequest('tarif/event/' . $this->getId(), methodType::POST, $token, $body, null);
    }

    public function removeTarif($id, $token){
        $body = array("id=".$id);
        return $apiReturn =  parent::sendRequest('tarif/event/' . $this->getId(), methodType::DELETE, $token, $body, null);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name, $token){
        $body = array("name=".$name);
        return $apiReturn =  parent::sendRequest('event/name/' . $this->getId(), methodType::PUT, $token, $body, null);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description, $token){
        $body = array("description=".$description);

        return $apiReturn =  parent::sendRequest('event/description/' . $this->getId(), methodType::PUT, $token, $body, null);
    }

    public function getDateStart()
    {
        return self::dateToHuman($this->dateStart);
    }

    public function getDateEnd()
    {
        return self::dateToHuman($this->dateEnd);
    }

    public function setDates($dateStart, $dateEnd, $token){
        $body = array();
        array_push($body, "dateStart=".$dateStart);
        array_push($body, "dateEnd=".$dateEnd);
        return $apiReturn =  parent::sendRequest('event/dates/' . $this->getId(), methodType::PUT, $token, $body, null);
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setLocal($country, $city, $postalCode, $adresse, $lat, $lng, $token){
        $body = array();
        array_push($body, "country=".$country);
        array_push($body, "city=".$city);
        array_push($body, "postalCode=".$postalCode);
        array_push($body, "adresse=".$adresse);
        array_push($body, "lat=".$lat);
        array_push($body, "lng=".$lng);
        return $apiReturn =  parent::sendRequest('event/local/' . $this->getId(), methodType::PUT, $token, $body, null);
    }

    public function isBooking()
    {
        return $this->booking;
    }

    public function setBooking($booking, $token){
        $body = array("booking=".$booking);
        return $apiReturn =  parent::sendRequest('event/booking/' . $this->getId(), methodType::PUT, $token, $body, null);
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active, $token){
        $body = array("active=".$active);
        return $apiReturn =  parent::sendRequest('event/active/' . $this->getId(), methodType::PUT, $token, $body, null);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getApiReturn()
    {
        return $this->apiReturn;
    }
}