<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 20/04/2018
 * Time: 14:44
 */

class Entities extends RequestApi
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCategorie(){
        $listCategorie = array();

        $apiReturn =  parent::sendRequest('categorie', methodType::GET, null, null, null);
        if($apiReturn->isSucess()){
            foreach ($apiReturn->getJsonList() as $c){
                $categorie = new Categorie($c['id'], $c['name']);
                array_push($listCategorie, $categorie);
            }
        }else{
            array_push($listCategorie, $apiReturn->getMessage());
        }

        return $listCategorie;
    }

    public function getAllClientele(){
        $listClientele = array();

        $apiReturn =  parent::sendRequest('clientele', methodType::GET,null, null, null);
        if($apiReturn->isSucess()){
            foreach ($apiReturn->getJsonList() as $c){
                $clientele = new Clientele($c['id'], $c['name']);
                array_push($listClientele, $clientele);
            }
        }else{
            array_push($listClientele, $apiReturn->getMessage());
        }

        return $listClientele;
    }
}