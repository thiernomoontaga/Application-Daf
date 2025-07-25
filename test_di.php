<?php

// Script de test pour l'injection de dépendances

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/env.php';

use App\Core\App;

try {
    // Initialiser le container
    App::init();

    echo "=== Test d'injection de dépendances ===\n\n";

    // Test 1: Récupération d'un service simple
    echo "1. Test Database service...\n";
    $database = App::get('database');
    echo "✓ Database service créé: " . get_class($database) . "\n\n";

    // Test 2: Récupération d'un repository avec dépendances
    echo "2. Test CitoyenRepository avec injection...\n";
    $citoyenRepo = App::get('citoyen_repository');
    echo "✓ CitoyenRepository créé: " . get_class($citoyenRepo) . "\n\n";

    // Test 3: Récupération d'un service avec dépendances
    echo "3. Test CitoyenService avec injection...\n";
    $citoyenService = App::get('citoyen_service');
    echo "✓ CitoyenService créé: " . get_class($citoyenService) . "\n\n";

    // Test 4: Récupération via interface
    echo "4. Test résolution d'interface...\n";
    $citoyenServiceByInterface = App::get('Src\\Service\\ICitoyenService');
    echo "✓ Service récupéré via interface: " . get_class($citoyenServiceByInterface) . "\n\n";

    // Test 5: Test singleton
    echo "5. Test singleton...\n";
    $citoyenService2 = App::get('citoyen_service');
    $isSingleton = $citoyenService === $citoyenService2;
    echo "✓ Singleton vérifié: " . ($isSingleton ? "OUI" : "NON") . "\n\n";

    // Test 6: Création de contrôleur avec injection
    echo "6. Test contrôleur avec injection...\n";
    $controller = App::get('Src\\Controller\\CitoyenController');
    echo "✓ CitoyenController créé: " . get_class($controller) . "\n\n";

    echo "=== Tous les tests réussis! ===\n";
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
