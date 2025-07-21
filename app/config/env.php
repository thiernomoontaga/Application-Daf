<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(dirname(__DIR__,2));
$dotenv->load();
 define("DB_NAME",$_ENV["DB_NAME"]);
  define("DB_USER_POSTGRES",$_ENV['DB_USER_POSTGRES']);
  define('DB_PASS_POSTGRES',$_ENV["DB_PASS_POSTGRES"]);
  define('DB_HOST_POSTGRES',$_ENV["DB_HOST_POSTGRES"]);
  define('DB_DSN_POSTGRES',$_ENV["DB_DSN_POSTGRES"]);
