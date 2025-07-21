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
      self::$pdo = new PDO(DB_DSN, USER, PASSWORD);
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return self::$pdo;
  }

}

