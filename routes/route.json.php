<?php

// Configuration des routes pour l'API
$routes = [
    [
        'path' => '/api/v1',
        'controller' => 'Src\\Controller\\HomeController',
        'action' => 'index',
        'methods' => ['GET'],
        'middlewares' => []
    ],
    [
        'path' => '/api/v1/citoyens',
        'controller' => 'Src\\Controller\\CitoyenController',
        'action' => 'index',
        'methods' => ['GET'],
        'middlewares' => []
    ],
    [
        'path' => '/api/v1/citoyens',
        'controller' => 'Src\\Controller\\CitoyenController',
        'action' => 'create',
        'methods' => ['POST'],
        'middlewares' => []
    ],
    [
        'path' => '/api/v1/citoyens/search',
        'controller' => 'Src\\Controller\\CitoyenController',
        'action' => 'search',
        'methods' => ['GET'],
        'middlewares' => []
    ],
    [
        'path' => '/api/v1/citoyens/{cni}',
        'controller' => 'Src\\Controller\\CitoyenController',
        'action' => 'show',
        'methods' => ['GET'],
        'middlewares' => []
    ],
    [
        'path' => '/api/v1/citoyens/{cni}',
        'controller' => 'Src\\Controller\\CitoyenController',
        'action' => 'update',
        'methods' => ['PUT', 'PATCH'],
        'middlewares' => []
    ],
    [
        'path' => '/api/v1/citoyens/{cni}',
        'controller' => 'Src\\Controller\\CitoyenController',
        'action' => 'delete',
        'methods' => ['DELETE'],
        'middlewares' => []
    ]
];

// Configuration des middlewares
$middlewares = [
    // Ajoutez ici vos middlewares si nécessaire
    // 'auth' => 'App\\Middleware\\AuthMiddleware',
    // 'cors' => 'App\\Middleware\\CorsMiddleware',
];
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
