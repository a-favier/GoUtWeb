<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 20/04/2018
 * Time: 14:45
 */

class User extends RequestApi
{
    private $pseudo, $firstName, $lastName, $dateBorn, $mail, $tel, $authToken;

    private $apiReturn;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewUser($pseudo, $firstName, $lastName, $dateBorn, $mail, $tel, $password){
        $body = array();

        if(!is_null($pseudo)) array_push($body,"pseudo=".$pseudo);
        if(!is_null($firstName)) array_push($body,"firstName=".$firstName);
        if(!is_null($lastName)) array_push($body,"lastName=".$lastName);
        if(!is_null($dateBorn)) array_push($body,"dateBorn=".$dateBorn);
        if(!is_null($mail)) array_push($body,"mail=".$mail);
        if(!is_null($tel)) array_push($body,"tel=".$tel);
        if(!is_null($password)) array_push($body, "password=".$password);

        $apiReturn =  parent::sendRequest('user', methodType::POST, null, $body, null);
        $this->apiReturn = $apiReturn;
        return $apiReturn;
    }

    public function fillUserByPseudo($pseudo){
        $apiReturn =  parent::sendRequest('user/user/' . $pseudo, methodType::GET, null, null, null);
        $this->apiReturn = $apiReturn;
        if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
            self::fillUserByJson($apiReturn->getJsonList()[0]);
        }
    }

    public function fillUserConnect($pseudo, $password){
        $body = array("pseudo=".$pseudo, "password=".$password);
        $apiReturn =  parent::sendRequest('auth/login/', methodType::POST, null, $body, null);
        $this->apiReturn = $apiReturn;
        if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
            self::fillUserByJson($apiReturn->getJsonList()[0]);
        }
    }

    public function fillUserByJson($result){
        if(isset($result['pseudo'])) $this->pseudo = $result['pseudo'];
        if(isset($result['firstName'])) $this->firstName = $result['firstName'];
        if(isset($result['lastName'])) $this->lastName = $result['lastName'];
        if(isset($result['dateBorn'])) $this->dateBorn = $result['dateBorn'];
        if(isset($result['mail'])) $this->mail = $result['mail'];
        if(isset($result['tel'])) $this->tel = $result['tel'];
        if(isset($result['authtoken'])) $this->authToken = $result['authtoken'];
    }

    public function getMyEvents(){
        $listEvent = array();

        $apiReturn =  parent::sendRequest('event/user/' . $this->pseudo, methodType::GET, null, null, null);
        if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
            foreach ($apiReturn->getJsonList() as $e){
                array_push($listEvent, $e['id'] = $e['name']);
            }
        }
        return $listEvent;
    }

    public function putBorn($dateBorn){
        if(!is_null($dateBorn)){
            $body = array("dateBorn=". $dateBorn);
            $apiReturn =  parent::sendRequest('user/born/' . $this->pseudo, methodType::PUT, $this->authToken, $body, null);
            if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
                self::fillUserByJson($apiReturn->getJsonList()[0]);
            }
            return $apiReturn->getMessage();
        }else{
            return 'Date born can\'t be null';
        }
    }

    public function putNames($firstName, $lastName){
        if(!is_null($firstName) || !is_null($lastName) ){
            $body = array();
            if(!is_null($firstName)) array_push($body,"firstName=".$firstName);
            if(!is_null($lastName)) array_push($body,"lastName=".$lastName);

            $apiReturn =  parent::sendRequest('user/names/' . $this->pseudo, methodType::PUT, $this->authToken, $body, null);
            if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
                self::fillUserByJson($apiReturn->getJsonList()[0]);
            }
            return $apiReturn->getMessage();
        }else{
            return 'Names can\'t be null';
        }
    }

    public function putMail($mail){
        if(!is_null($mail)){
            $body = array("mail=". $mail);
            $apiReturn =  parent::sendRequest('user/mail/' . $this->pseudo, methodType::PUT, $this->authToken, $body, null);
            if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
                self::fillUserByJson($apiReturn->getJsonList()[0]);
            }
            return $apiReturn->getMessage();
        }else{
            return 'mail can\'t be null';
        }
    }

    public function putPassword($pass){
        if(!is_null($pass)){
            $body = array("pass=". $pass);
            $apiReturn =  parent::sendRequest('user/mail/' . $this->pseudo, methodType::PUT, $this->authToken, $body, null);
            if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
                self::fillUserByJson($apiReturn->getJsonList()[0]);
            }
            return $apiReturn->getMessage();
        }else{
            return 'Password can\'t be null';
        }
    }

    public function putTel($tel){
        if(!is_null($tel)){
            $body = array("tel=". $tel);
            $apiReturn =  parent::sendRequest('user/mail/' . $this->pseudo, methodType::PUT, $this->authToken, $body, null);
            if($apiReturn->isSucess() && !empty($apiReturn->getJsonList())){
                self::fillUserByJson($apiReturn->getJsonList()[0]);
            }
            return $apiReturn->getMessage();
        }else{
            return 'Tel can\'t be null';
        }
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getDateBorn()
    {
        return $this->dateBorn;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }

    public function getApiReturn()
    {
        return $this->apiReturn;
    }



    public function toString(){
        var_dump($this);
    }

}