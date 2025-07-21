<?php
namespace Seeders\Seeders;


use PDO;
use Exception;
use PDOException;

class Seeder
{
    private  PDO $pdo;
    private string $driver;
    public  function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
        $this->driver=$pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    }
     public function  run ()
     {
         try {
            
        $this->seedDatabase();
         echo ( "insertion faite avec  succes thierno boullette  bou ramma ");
    } catch ( PDOException $e) {
             die("echec insertion des donnes  thierno boullette ".$e->getMessage());
         }
     }
    public  function seedDatabase()
    {
        $sql=match ($this->driver) {
            "mysql" => file_get_contents(__DIR__.'/../databases/insert_mysql.sql') ,
            "pgsql" => file_get_contents(__DIR__.'/../databases/insert_pgsql.sql') ,
            default => throw new Exception("le driver est pas pas  thierno bouellete"),
 
        };
         return $this->pdo->exec($sql);
        
    }

}