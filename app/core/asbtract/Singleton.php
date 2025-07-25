<?php
namespace App\Config;

class Singleton{
  protected static ?Singleton $instance = null;
  private function __construct()
  {
    
  }
  private static function getInstance(){
    if(self::$instance === null){
      self::$instance = new self();
    }
    return self::$instance;
  }
}

