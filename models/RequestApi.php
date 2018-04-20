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

    private $route;
    private $method
    private $token;
    private $body;
    private $params;

    public function __construct()
    {
        /** Creation de la chaine de connexion a l'API */
        $api_config_xml = file_get_contents('./config.xml');
        $api_config = new SimpleXMLElement($api_config_xml);
        $this->strConnectApi = 'http://' . $api_config->adresse . ':' . $api_config->port . '/api/';
    }

    private function initCurl($strRequest){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $strRequest);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        return $curl;
    }

    private function defineHeader(){

    }

    private function defineBody(){

    }

    private function defineParams($params){
        $strParams = "?";
        if(!is_null($params)){
            foreach ($params as $p){
                $strParams += $p + '&';
            }
        }
        $strParams = rtrim($p, '&');

    }

    private function sendRequest($strRequest, $method, $route, $token, $body, $params){
        /** Mise en forme des parametre pour la requete find */
        $this->defineParams($params);

        /** Initialisation de la connexion */
        $curl = $this->initCurl($route);

        $method = strtoupper($method);

        curl_close($curl);
    }

    private function

}