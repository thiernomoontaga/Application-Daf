<?php

namespace App\Core;

use Exception;

class Router
{
    public static function resolve()
    {
        global $routes;
        global $middlewares;

        // Vérification que les routes sont définies
        if (!isset($routes) || !is_array($routes)) {
            http_response_code(500);
            echo json_encode(['error' => 'Configuration des routes manquante ou invalide.']);
            return;
        }

        // Initialiser les middlewares si non définis
        if (!isset($middlewares)) {
            $middlewares = [];
        }

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($routes as $route) {
            // Vérification de la structure de la route
            if (!isset($route['path'], $route['controller'], $route['action'], $route['methods'])) {
                continue; // Ignorer les routes mal formées
            }

            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches) && in_array($method, $route['methods'])) {
                array_shift($matches); // Le premier élément est l'URL complète
                $controller = $route['controller'];
                $action = $route['action'];

                // Exécution des middlewares (si définis)
                if (!empty($route['middlewares']) && is_array($route['middlewares'])) {
                    foreach ($route['middlewares'] as $middlewareName) {
                        if (array_key_exists($middlewareName, $middlewares)) {
                            $middlewareClass = $middlewares[$middlewareName];
                            if (class_exists($middlewareClass)) {
                                $middlewareInstance = new $middlewareClass();
                                if (is_callable($middlewareInstance)) {
                                    $result = $middlewareInstance(); // __invoke
                                    // Si le middleware retourne false, arrêter l'exécution
                                    if ($result === false) {
                                        return;
                                    }
                                }
                            } else {
                                http_response_code(500);
                                echo json_encode(['error' => "Middleware '$middlewareName' introuvable."]);
                                return;
                            }
                        } else {
                            http_response_code(500);
                            echo json_encode(['error' => "Middleware '$middlewareName' non configuré."]);
                            return;
                        }
                    }
                }

                // Appel du contrôleur avec injection de dépendances
                if (class_exists($controller)) {
                    try {
                        // Utiliser App pour créer l'instance avec injection de dépendances
                        $controllerInstance = App::get($controller);

                        if (method_exists($controllerInstance, $action)) {
                            call_user_func_array([$controllerInstance, $action], $matches);
                            return;
                        } else {
                            http_response_code(500);
                            echo json_encode(['error' => "Méthode '$action' introuvable dans le contrôleur '$controller'."]);
                            return;
                        }
                    } catch (Exception $e) {
                        http_response_code(500);
                        echo json_encode(['error' => 'Erreur lors de la création du contrôleur.', 'details' => $e->getMessage()]);
                        return;
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => "Contrôleur '$controller' introuvable."]);
                    return;
                }
            }
        }

        // Aucune route trouvée
        http_response_code(404);
        echo json_encode(['error' => 'Route non trouvée.', 'uri' => $uri, 'method' => $method]);
    }

    private static function renderJson(array $data, int $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
