<?php

namespace Migration\Migration;

use Exception;
use PDO;
use PDOException;

class Migration
{
    private PDO $pdo;
    private string $driver;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

    public function run()
    {
        echo "Démarrage de la migration...\n";
        $this->createTables();
        echo "✅ Tables créées avec succès!\n";
    }

    public function createTables()
    {
        echo "Création des tables...\n";

        $sql = match ($this->driver) {
            "mysql" => file_get_contents(__DIR__ . "/../databases/script_create_mysql.sql"),
            'pgsql' => file_get_contents(__DIR__ . "/../databases/script_create_pgsql.sql"),
            default => throw new Exception("Driver '{$this->driver}' non supporté")
        };

        if (empty(trim($sql))) {
            throw new Exception("Le fichier SQL pour {$this->driver} est vide");
        }

        // Exécuter le script SQL
        $this->pdo->exec($sql);
        echo "✅ Script SQL exécuté pour driver: {$this->driver}\n";
    }
}
