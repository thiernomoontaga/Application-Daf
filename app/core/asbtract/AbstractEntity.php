<?php
namespace App\Core\Abstract;

abstract class AbstractEntity{

    abstract public static function toObject():static;
    abstract public function toArray(object $data):array;
    public function toJson(){}
}

