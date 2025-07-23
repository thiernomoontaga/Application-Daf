<?php
namespace Migration\Migration;

use App\Core\Database;
use Exception;
use PDO;
use PDOException;

// exec est unr requete de  de executer une requete
class  Migration
{
        private PDO $pdo;
        private  string $driver;

        public function __construct(PDO $pdo)
        {
            $this->pdo=$pdo; 
            $this->driver=$pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

        }
        public function run()
        {
            $this->createDatabase();
             $this->createTable();
              echo 'thierno boullette !!!!!';

        }

        public function createDatabase()
        {
          
            if($this->driver === "mysql")
            {
             
             $this->pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
            $this->pdo->exec("USE " . DB_NAME);
            }
            elseif ($this->driver==="pgsql")
            {
                try
                {

                  $mrsfall= new PDO ("pgsql:host=127.0.0.1;dbname=postgres;port=5432",DB_USER_POSTGRES,DB_PASS_POSTGRES,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]
                    );
                    $stmt=$this->pdo->prepare("select 1  from   pg_database where datname = :db_name");
                    $stmt->execute([
                        ":db_name"=>DB_NAME
                    ]);
                    if($stmt->fetch())
                    {
                        echo "la base de donne   existe déja ".DB_NAME;
                    } else
                    {
                        $this->pdo->exec("CREATE DATABASE " .DB_NAME);
                        echo "La database de donnée est " .DB_NAME . "avec succés";
                    }
                      $mrsfall=null;

                      $this->pdo=new PDO (DB_DSN_POSTGRES,DB_USER_POSTGRES,DB_PASS_POSTGRES,[
                        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                    ]);
                    $this->driver=$this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

                    
                }   
                catch(PDOException $e)   
                {
                    throw new Exception("erreur executionn  thierno boullette ".$e);
                }
            
            }
              
        }
        public function  createTable()
        {
            $sql= match($this->driver)
            {
                "mysql" =>file_get_contents( __DIR__. "/../databases/script_create_mysql.sql"),
                'pgsql'=>file_get_contents( __DIR__. "/../databases/script_create_pgsql.sql"),
                default=>  throw new Exception('le driver exixte pas')
            };
            return $this->pdo->exec($sql);


        }                   
            
    }










