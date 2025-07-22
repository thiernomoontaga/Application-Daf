<?php
namespace App\Core;
use PDO;
class Database {
  private static ?PDO $pdo = null;

  private function __construct()
  {
    
  }
  public static function getInstance(){
    if(self::$pdo === null){
define('DB_PASS_POSTGRES', $_ENV['DB_PASS_POSTGRES']);
self::$pdo = new PDO(DB_DSN_POSTGRES, DB_USER_POSTGRES);
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return self::$pdo;
  }

}

