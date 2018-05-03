<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 02/05/2018
 * Time: 14:19
 */

class ApiReturn
{
    private $htppCode, $sucess, $message, $jsonList;

    public function __construct($htppCode, $sucess, $message, $jsonList)
    {
        $this->htppCode = $htppCode;
        $this->sucess = $sucess;
        $this->message = $message;
        $this->jsonList = $jsonList;
    }

    public function getHtppCode()
    {
        return $this->htppCode;
    }

    public function isSucess()
    {
        return $this->sucess;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getJsonList()
    {
        return $this->jsonList;
    }



}