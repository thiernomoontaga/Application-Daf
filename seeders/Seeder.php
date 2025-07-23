<?php
namespace Seeder\Seeder;


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
         echo ( "insertion faite avec  succes ");
    } catch ( PDOException $e) {
             die("echec insertion des donnes   ".$e->getMessage());
         }
     }
    public  function seedDatabase()
    {
        $sql=match ($this->driver) {
            "mysql" => file_get_contents(__DIR__.'/../databases/insert_mysql.sql') ,
            "pgsql" => file_get_contents(__DIR__.'/../databases/insert_pgsql.sql') ,
            default => throw new Exception("le driver  n' existe pas  "),
 
        };
         return $this->pdo->exec($sql);
        
    }

}