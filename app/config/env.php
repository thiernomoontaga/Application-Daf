<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(dirname(__DIR__,2));
$dotenv->load();


define('DB_DSN_POSTGRES', $_ENV['DB_DSN_POSTGRES']);
define('DB_USER_POSTGRES', $_ENV['DB_USER_POSTGRES']);
define('DB_PASS_POSTGRES', $_ENV['DB_PASS_POSTGRES']);



define('DB_DRIVER', $_ENV['DB_DRIVER']);

define('DB_NAME', $_ENV['DB_NAME']);


define('BASE_DSN_MYSQl', $_ENV['BASE_DSN_MYSQl']);
define('DB_USER_MYSQL', $_ENV['DB_USER_MYSQL']);
define('DB_PASS_MYSQL', $_ENV['DB_PASS_MYSQL']);









