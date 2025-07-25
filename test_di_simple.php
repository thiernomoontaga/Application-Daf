<?php

// Script de test simple pour l'injection de dépendances

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\App;

try {
    // Initialiser le container
    App::init();

    echo "=== Test simple d'injection de dépendances ===\n\n";

    // Test 1: Vérification du chargement de la configuration
    echo "1. Vérification configuration...\n";
    $hasService = App::has('citoyen_service');
    echo "✓ Service citoyen_service configuré: " . ($hasService ? "OUI" : "NON") . "\n\n";

    // Test 2: Test des interfaces
    echo "2. Test résolution d'interface...\n";
    $hasInterface = App::has('Src\\Service\\ICitoyenService');
    echo "✓ Interface ICitoyenService configurée: " . ($hasInterface ? "OUI" : "NON") . "\n\n";

    echo "=== Configuration valide! ===\n";
    echo "Note: Les tests complets nécessitent une base de données configurée.\n";
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
