<?php

namespace Seeders;

use App\Core\App;
use App\Core\Database;
use Src\Service\IUploadService;
use PDO;
use Exception;
use PDOException;

class Seeder
{
    private IUploadService $uploadService;

    public function __construct()
    {
        // Récupération du service d'upload via le conteneur DI
        $this->uploadService = App::get(IUploadService::class);
    }

    public function run()
    {
        try {
            $this->seedCitoyens();
            echo "Insertion des données terminée avec succès!\n";
        } catch (PDOException $e) {
            die("Échec de l'insertion des données: " . $e->getMessage() . "\n");
        } catch (Exception $e) {
            die("Erreur: " . $e->getMessage() . "\n");
        }
    }

    public function seedCitoyens()
    {
        $db = Database::getInstance();

        echo "📊 Début du seeding...\n\n";

        // Images disponibles dans le dossier uploads
        echo "1️⃣ Upload des copies CNI vers Cloudinary...\n";
        $images = [
            '20770231_Sandy_Tech-02_Single-04.jpg',
            '25001340_7030842.jpg',
            '6402635_3270759.jpg'
        ];

        // Upload des images vers Cloudinary et récupération des URLs
        $uploadedImages = [];
        $uploadsPath = '/home/twist/dev-web-ecsa/php2/web/Application-Daf/public/images/uploads/';

        foreach ($images as $image) {
            $imagePath = $uploadsPath . $image;
            if (file_exists($imagePath)) {
                echo "   📤 Upload de la copie CNI: {$image}...\n";
                $cloudinaryUrl = $this->uploadService->upload($imagePath, [
                    'folder' => 'citoyens/copies_cni',
                    'public_id' => pathinfo($image, PATHINFO_FILENAME)
                ]);

                if ($cloudinaryUrl) {
                    $uploadedImages[] = $cloudinaryUrl;
                    echo "   ✓ Copie CNI uploadée: {$cloudinaryUrl}\n";
                } else {
                    echo "   ✗ Erreur lors de l'upload de {$image}\n";
                }
            } else {
                echo "   ⚠️ Fichier non trouvé: {$imagePath}\n";
            }
        }

        // Données de test pour les citoyens avec copies CNI
        echo "\n2️⃣ Création des citoyens...\n";
        $citoyens = [
            [
                'prenom' => 'Amina',
                'nom' => 'Sow',
                'cni' => '1990115000123',
                'date_naissance' => '1990-01-15',
                'lieu_naissance' => 'Dakar',
                'copie_cni' => $uploadedImages[0] ?? null
            ],
            [
                'prenom' => 'Marie',
                'nom' => 'Diop',
                'cni' => '1985072200123',
                'date_naissance' => '1985-07-22',
                'lieu_naissance' => 'Thiès',
                'copie_cni' => $uploadedImages[1] ?? null
            ],
            [
                'prenom' => 'John',
                'nom' => 'Doe',
                'cni' => '1992031000302',
                'date_naissance' => '1992-03-10',
                'lieu_naissance' => 'Saint-Louis',
                'copie_cni' => $uploadedImages[2] ?? null
            ],
            [
                'prenom' => 'Jane',
                'nom' => 'Doe',
                'cni' => '1988051800412',
                'date_naissance' => '1988-05-18',
                'lieu_naissance' => 'Kaolack',
                'copie_cni' => $uploadedImages[0] ?? null
            ],
            [
                'prenom' => 'Jin',
                'nom' => 'Doe',
                'cni' => '1993120300512',
                'date_naissance' => '1993-12-03',
                'lieu_naissance' => 'Ziguinchor',
                'copie_cni' => $uploadedImages[1] ?? null
            ]
        ];

        foreach ($citoyens as $citoyen) {
            $stmt = $db->prepare("
                INSERT INTO citoyens (prenom, nom, cni, date_naissance, lieu_naissance, copie_cni) 
                VALUES (:prenom, :nom, :cni, :date_naissance, :lieu_naissance, :copie_cni)
            ");
            $stmt->execute($citoyen);
            $copieCniStatus = $citoyen['copie_cni'] ? " (avec copie CNI)" : " (sans copie CNI)";
            echo "   ✓ Citoyen créé: {$citoyen['prenom']} {$citoyen['nom']}{$copieCniStatus}\n";
        }

        echo "\n📊 Résumé du seeding:\n";
        echo "   🖼️ " . count($uploadedImages) . " copies CNI uploadées sur Cloudinary\n";
        echo "   👥 " . count($citoyens) . " citoyens créés\n";
    }
}
