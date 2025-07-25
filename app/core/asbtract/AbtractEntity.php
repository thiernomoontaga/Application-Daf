<?php
namespace App\Core\Abstract;

abstract class AbtractEntity{

    abstract  public function toObject(array $data):array;
    abstract public function toArray(): array;
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

