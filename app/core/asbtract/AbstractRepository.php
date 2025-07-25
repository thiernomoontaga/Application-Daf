<?php

use App\Config\Singleton;
use App\Core\Abstract\IRepository;

abstract class AbstractRepository extends Singleton implements IRepository
{
    protected PDO $pdo;
    protected string $table;

    protected function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

}

