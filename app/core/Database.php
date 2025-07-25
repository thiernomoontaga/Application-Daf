<?php

namespace App\Core;

use PDO;

class Database
{
  private static ?PDO $pdo = null;

  private function __construct() {}
  
  public static function getInstance()
  {
    if (self::$pdo === null) {
      if (DB_DRIVER === 'mysql') {
        self::$pdo = new PDO(DB_DSN_MYSQL, DB_USER_MYSQL, DB_PASS_MYSQL);
      } elseif (DB_DRIVER === 'postgres') {
        self::$pdo = new PDO(DB_DSN_POSTGRES, DB_USER_POSTGRES, DB_PASS_POSTGRES);
      }
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return self::$pdo;
  }
}
