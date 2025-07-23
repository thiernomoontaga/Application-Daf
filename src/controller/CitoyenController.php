<?php

namespace Src\Controller;

use DateTimeZone;

class CitoyenController
{

    public function index()
    {
        // Logique pour récupérer la liste des citoyens
        echo json_encode(['message' => 'Liste des citoyens']);
    }

    public function show($cni)
    {
    	$ip = $_SERVER['REMOTE_ADDR'] ?? 'inconnue';
        $location = 'inconnue';
        $now = date('Y-m-d H:i:s');

        // var_dump($ip, $now, $cni, $location); // Debugging line
        // die();

        $citoyen = $cni; // $citoyenService->getCitoyenByNci($nci);

        if ($citoyen) {
            // LoggingService::logRecherche($nci, $now, $ip, $location, 'success');
            return $this->renderJson([
                'data' => $citoyen,
                'statut' => 'success',
                'code' => 200,
                'message' => "Le numéro de carte d'identité a été retrouvé"
            ]);
        } else {
            // LoggingService::logRecherche($nci, $now, $ip, $location, 'error');
            return $this->renderJson([
                'data' => null,
                'statut' => 'error',
                'code' => 404,
                'message' => "Le numéro de carte d'identité non retrouvé"
            ]);
        }
        echo json_encode(['message' => "Détails du citoyen avec CNI: $cni"]);
    }

    public function create()
    {
        // Logique pour créer un nouveau citoyen
        echo json_encode(['message' => 'Citoyen créé']);
    }

    public function update($cni)
    {
        // Logique pour mettre à jour un citoyen par son CNI
        echo json_encode(['message' => "Citoyen avec CNI: $cni mis à jour"]);
    }

    public function delete($cni)
    {
        // Logique pour supprimer un citoyen par son CNI
        echo json_encode(['message' => "Citoyen avec CNI: $cni supprimé"]);
    }

    public function search()
    {
        // Logique pour rechercher des citoyens
        echo json_encode(['message' => 'Recherche de citoyens']);
    }

    private function renderJson(array $data, int $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
