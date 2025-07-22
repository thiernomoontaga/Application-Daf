<?php

// Configuration des routes pour l'API

use Src\Controller\CitoyenController;
use Src\Controller\HomeController;

$routes = [
    '/api/v1' => [
        'controller' => HomeController::class,
        'action' => 'index',
        'methods' => ['GET']
    ],
    '/api/v1/citoyens' => [
        'controller' => CitoyenController::class,
        'action' => 'index',
        'methods' => ['GET']
    ],
    '/api/v1/citoyens/{nci}' => [
        'controller' => CitoyenController::class,
        'action' => 'show',
        'methods' => ['GET']
    ],
    '/api/v1/citoyens/create' => [
        'controller' => CitoyenController::class,
        'action' => 'create',
        'methods' => ['POST']
    ],
    '/api/v1/citoyens/search' => [
        'controller' => CitoyenController::class,
        'action' => 'search',
        'methods' => ['GET']
    ],
    
];

return $routes;


// return $routes = [
//     [
//         'path' => '/api/v1',
//         'controller' => HomeController::class,
//         'action' => 'index',
//         'methods' => ['GET']
//     ],
//     [
//         'path' => '/api/v1/citoyens',
//         'controller' => CitoyenController::class,
//         'action' => 'index',
//         'methods' => ['GET']
//     ],
//     [
//         'path' => '/api/v1/citoyens',
//         'controller' => CitoyenController::class,
//         'action' => 'create',
//         'methods' => ['POST']
//     ],
//     [
//         'path' => '/api/v1/citoyens/{cni}',
//         'controller' => CitoyenController::class,
//         'action' => 'show',
//         'methods' => ['GET']
//     ],
//     [
//         'path' => '/api/v1/citoyens/{cni}',
//         'controller' => CitoyenController::class,
//         'action' => 'update',
//         'methods' => ['PUT', 'PATCH']
//     ],
//     [
//         'path' => '/api/v1/citoyens/{cni}',
//         'controller' => CitoyenController::class,
//         'action' => 'delete',
//         'methods' => ['DELETE']
//     ],
//     [
//         'path' => '/api/v1/citoyens/search',
//         'controller' => CitoyenController::class,
//         'action' => 'search',
//         'methods' => ['GET']
//     ]
// ];

// pour router les requêtes
// foreach ($routes as $route) {
//     $path = $route['path'];
//     $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $path);
//     $pattern = '#^' . $pattern . '$#';

//     if (preg_match($pattern, $uri, $matches) && in_array($method, $route['methods'])) {
//         // ...
//     }
// }
