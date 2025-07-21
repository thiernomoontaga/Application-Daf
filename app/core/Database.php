<?php
namespace App\Core;

use PDO;

class Database
{
    private static ?PDO $pdo=null;
    private  function __construct()
    {

    
        
    }

    public  static function getInstance()
    {
        if (self::$pdo===null)
        {
            self::$pdo=new PDO(DB_DSN_POSTGRES,DB_USER_POSTGRES,DB_PASS_POSTGRES,
    [
                pdo::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
            ]);

        }
        return self::$pdo; 
    }
}
 
