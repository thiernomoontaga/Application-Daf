<?php

namespace Src\Controller;

class HomeController
{
    public function index()
    {
        echo json_encode([
            'message' => 'Bienvenue sur l\'API APPDAF',
            'version' => '1.0.0',
            'documentation' => 'https://example-appdaf.com/docs'
        ]);
    }
}
