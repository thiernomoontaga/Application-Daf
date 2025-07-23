<?php

abstract class AbstractRepository
{
    protected PDO $pdo;
    protected $table;

    protected function __construct()
    {
        $this->pdo = App::getDependency('Database');
    }


    abstract public function selectAll();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();

}