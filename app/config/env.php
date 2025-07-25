<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(dirname(__DIR__, 2));
$dotenv->load();


define('DB_DSN_POSTGRES', $_ENV['DB_DSN_POSTGRES']);
define('DB_USER_POSTGRES', $_ENV['DB_USER_POSTGRES']);
define('DB_PASS_POSTGRES', $_ENV['DB_PASS_POSTGRES']);



define('DB_DRIVER', $_ENV['DB_DRIVER']);

define('DB_NAME', $_ENV['DB_NAME'] ?? '');

define('DB_DSN_MYSQL', $_ENV['DB_DSN_MYSQL'] ?? '');
define('BASE_DSN_MYSQl', $_ENV['BASE_DSN_MYSQl'] ?? '');
define('DB_USER_MYSQL', $_ENV['DB_USER_MYSQL'] ?? '');
define('DB_PASS_MYSQL', $_ENV['DB_PASS_MYSQL'] ?? '');


// Cloudinary
define('CLOUDINARY_CLOUD_NAME', $_ENV['CLOUDINARY_CLOUD_NAME']);
define('CLOUDINARY_API_KEY', $_ENV['CLOUDINARY_API_KEY']);
define('CLOUDINARY_API_SECRET', $_ENV['CLOUDINARY_API_SECRET']);

define('UPLOAD_DIR', $_ENV['UPLOAD_DIR'] ?? 'images/uploads/');
