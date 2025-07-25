<?php

abstract class AbstractController
{
  public function __construct() {}

  protected function renderJson(array $data, int $status = 200): void
  {
    http_response_code($status);

    // Headers CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, Origin, X-Api-Key');
    header('Access-Control-Expose-Headers: X-Total-Count');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');

    // Content-Type JSON
    header('Content-Type: application/json');

    // Gérer les requêtes OPTIONS (preflight)
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      exit;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
  }

  protected function getClientIp(): string
  {
    // Vérifier les en-têtes de proxy communs
    $headers = [
      'HTTP_X_FORWARDED_FOR',
      'HTTP_X_REAL_IP',
      'HTTP_CLIENT_IP',
      'HTTP_X_CLUSTER_CLIENT_IP',
      'HTTP_X_FORWARDED',
      'HTTP_FORWARDED_FOR',
      'HTTP_FORWARDED',
      'REMOTE_ADDR'
    ];

    foreach ($headers as $header) {
      if (!empty($_SERVER[$header])) {
        $ips = explode(',', $_SERVER[$header]);
        $ip = trim($ips[0]);

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
          return $ip;
        }
      }
    }

    return $_SERVER['REMOTE_ADDR'] ?? 'inconnue';
  }
}
