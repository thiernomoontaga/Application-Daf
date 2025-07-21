<?php
namespace App\Core;

class Router {
    public static function resolver() {
        $route = require __DIR__.'/../../routes/route.web.php';
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if(isset($route[$uri])) {
            $middlewares = require __DIR__.'/../config/middlewares.php';
            
            // Exécuter les middlewares
            if(isset($route[$uri]['middlewares'])) {
                foreach($route[$uri]['middlewares'] as $middleware) {
                    $middlewareClass = $middlewares[$middleware];
                    $middlewareInstance = new $middlewareClass();
                    $middlewareInstance();
                }
            }
            
            // Exécuter le contrôleur
            $controllerName = $route[$uri]['controller'];
            $controllerAction = $route[$uri]['action'];
            $controller = new $controllerName();
            $controller->$controllerAction();
        } else {
            // Envoyer un vrai header 404
            http_response_code(404);
            echo '404 - Page not found';
        }
    }
}