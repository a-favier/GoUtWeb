<?php
/**
 * Created by PhpStorm.
 * User: al.favier
 * Date: 20/04/2018
 * Time: 14:44
 */

class Tarif
{
    private $id, $name, $price;

    public function __construct($id, $name, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }





}