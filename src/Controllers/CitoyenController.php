<?php 

namespace App\Controller;

use App\Core\AbstractController;
use App\Repository\CitoyenRepository;
use App\Service\JournalisationService;

class CitoyenController extends AbstractController
{
    public function rechercherParNci(string $nci): void
    {
        $repo = new CitoyenRepository();
        $citoyen = $repo->findByNci($nci);

        // Journaliser la recherche
        $journal = new JournalisationService();
        $success = $citoyen !== null;
        $journal->logRecherche($nci, $success);

        if ($citoyen) {
            $this->renderJSON([
                'data' => $citoyen,
                'statut' => 'success',
                'code' => 200,
                'message' => "Le numéro de carte d'identité a été retrouvé"
            ], 200);
        } else {
            $this->renderJSON([
                'data' => null,
                'statut' => 'error',
                'code' => 404,
                'message' => "Le numéro de carte d'identité non retrouvé"
            ], 404);
        }
    }
}
