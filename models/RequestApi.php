<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 20/04/2018
 * Time: 14:45
 */

class RequestApi
{
    private $strConnectApi;

    private $route, $method, $token, $body, $params;


    public function __construct()
    {
        /** Creation de la chaine de connexion a l'API */
        $config = file_get_contents('../config.xml');
        $config = new SimpleXMLElement($config);
        $this->strConnectApi = 'http://' . $config->adresseApi . ':' . $config->port . '/api/';
    }

    private function initCurl($strRequest, $method){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $strRequest);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        switch ($method){
            case methodType::POST:
                curl_setopt($curl, CURLOPT_POST, true);
                break;
            case methodType::PUT:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case methodType::DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }

        return $curl;
    }

    private function defineHeader($curl, $token){
        $header = array('Content-Type: application/x-www-form-urlencoded');

        if(!is_null($token)){
            array_push($header, 'auth-token: ' . $token);
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        return $curl;
    }

    private function defineBody($curl, $body){
        $strbody = "";
        if(!is_null($body)){
            foreach ($body as $p){
                $strbody = $strbody . $p . '&';
            }
        }
        $strbody = rtrim($strbody, '&');

        curl_setopt($curl, CURLOPT_POSTFIELDS, $strbody);

        return $curl;
    }

    private function defineParams($params){
        $strParams = "?";
        if(!is_null($params)){
            foreach ($params as $p){
                $strParams = $strParams . $p . '&';
            }
        }
        $strParams = rtrim($strParams, '&');
        return $strParams;
    }

    public function sendRequest($route, $method, $token, $body, $params){
        /** Mise en forme des parametre pour la requete find */
        if(is_null($params)){
            $route = $this->strConnectApi . rtrim($route, '/');
        }else{
            $route = $this->strConnectApi . rtrim($route, '/') . $this->defineParams($params);
        }

        /** Initialisation de la connexion */
        $method = strtoupper($method);

        $curl = $this->initCurl($route, $method);
        $curl = $this->defineHeader($curl, $token);

        if(!strcmp($method, methodType::GET) == 0){
            $curl = $this->defineBody($curl, $body);
        }

        /** Execution de la requete */
        $execute = curl_exec($curl);
        $info = curl_getinfo($curl);

        switch ($info['http_code']){
            case 0:
                $result = new ApiReturn(500, false, "Serveur not found", array(null));
                break;
            case 404:
                $result = new ApiReturn(404, false, "Ressource not found", array(null));
                break;
            case 400:
                $result = new ApiReturn(400, false, "Ressource not found", $this->normaliseJSON($execute));
                break;
            case 401:
                $result = new ApiReturn(400, $this->normaliseJSON($execute)[0]['success'], $this->normaliseJSON($execute)[0]['message'], $this->normaliseJSON($execute));
                break;
            case 200:
                $result = new ApiReturn(200, true, "Sucess", $this->normaliseJSON($execute));
                break;
            case 201:
                $result = new ApiReturn(200, true, "Sucess create", $this->normaliseJSON($execute));
                break;
            default:
                echo $info['http_code'] . " no way";
                $result = new ApiReturn(null, null ,null, null);
        }

        curl_close($curl);
        return $result;
    }

    private function normaliseJSON($json){
        $result = array();
        $json = json_decode($json);
        foreach ($json as $j){
            array_push($result, get_object_vars($j));
        }
        return $result;
    }
}