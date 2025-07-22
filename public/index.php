<?php

use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/route.json.php';

Router::resolve();