<?php

abstract class AbtractEntity{

    abstract  public function toObject(array $data):array;
    abstract public function toArray(object $data);
    public function toJson(){}
}

