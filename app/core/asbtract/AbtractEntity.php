<?php

abstract class AbtractEntity{

    // abstract  public function toObject(array $data);
    abstract public function toArray();
    public function toJson(){
        return json_encode($this->toArray());  
    }

    
}
