<?php

use App\Core\Router;
use App\Core\App;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/env.php';
require_once __DIR__ . '/../routes/route.json.php';

// Initialiser le container d'injection de dépendances
App::init();

Router::resolve();
