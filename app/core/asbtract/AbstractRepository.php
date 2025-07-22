<?php

abstract class AbstractRepository
{
    protected PDO $pdo;

    protected function __construct()
    {

    }


    abstract public function selectAll();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();

}

