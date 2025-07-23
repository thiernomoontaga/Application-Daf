<?php

namespace App\Core;

class Router
{
    public static function resolve()
    {
        $routes = require __DIR__ . '/../../routes/route.json.php'; // chemin vers routes
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($routes as $path => $route) {
            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $path);
            // var_dump($pattern); // Debugging line
            // die();
            $pattern = '#^' . $pattern . '$#';
            // var_dump($pattern); // Debugging line
            // die();
            
            if (preg_match($pattern, $uri, $matches) && in_array($method, $route['methods'])) {

                array_shift($matches);
                // var_dump($matches); // Debugging line
                // die();
                $controller = $route['controller'];
                $action = $route['action'];

                if (class_exists($controller) && method_exists($controller, $action)) {
                    $instance = new $controller();
                    call_user_func_array([$instance, $action], $matches);
                    return;
                } else {
                    self::renderJson([
                        'data' => null,
                        'statut' => 'error',
                        'code' => 500,
                        'message' => 'Contrôleur ou méthode introuvable'
                    ], 500);
                }
            }
        }

        // Si aucune route ne correspond
        self::renderJson([
            'data' => null,
            'statut' => 'error',
            'code' => 404,
            'message' => 'Ressource introuvable'
        ], 404);
    }

    private static function renderJson(array $data, int $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
