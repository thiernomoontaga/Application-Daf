<?php

namespace Src\Controller;

require_once __DIR__ . '/../../app/core/asbtract/AbstractController.php';

use AbstractController;
use Src\Service\ICitoyenService;
use Src\Service\ILoggingService;
use Src\Entity\Citoyen;
use Exception;

class CitoyenController extends AbstractController
{
    private ICitoyenService $citoyenService;
    private ILoggingService $loggingService;

    public function __construct(ICitoyenService $citoyenService, ILoggingService $loggingService)
    {
        parent::__construct();
        $this->citoyenService = $citoyenService;
        $this->loggingService = $loggingService;
    }

    public function index()
    {
        try {
            $citoyens = $this->citoyenService->getAllCitoyens(['limit' => 10, 'offset' => 0]);
            if (empty($citoyens)) {
                $this->renderJson([
                    'data' => null,
                    'statut' => 'error',
                    'code' => 404,
                    'message' => "Aucun citoyen trouvé"
                ], 404);
                return;
            }
            $this->renderJson([
                'data' => $citoyens,
                'statut' => 'success',
                'code' => 200,
                'message' => "Liste des citoyens récupérée avec succès"
            ]);
        } catch (Exception $e) {
            $this->renderJson([
                'data' => null,
                'statut' => 'error',
                'code' => 500,
                'message' => "Erreur serveur: " . $e->getMessage()
            ], 500);
        }
    }
    public function show($cni)
    {
        $ip = $this->getClientIp();
        $location = 'inconnue';
        $now = date('Y-m-d H:i:s');

        $citoyen = $this->citoyenService->getCitoyenByCni($cni);
        if (!$citoyen) {
            $this->loggingService->log($cni, $now, $ip, $location, 'error');
            return $this->renderJson([
                'data' => null,
                'statut' => 'error',
                'code' => 404,
                'message' => "numéro de carte d'identité non retrouvé: $cni"
            ], 404);
        }

        $this->loggingService->log($cni, $now, $ip, $location, 'success');
        return $this->renderJson([
            'data' => Citoyen::toArray($citoyen),
            'statut' => 'success',
            'code' => 200,
            'message' => "Le numéro de carte d'identité a été retrouvé"
        ]);
    }

    public function create()
    {
        // Logique pour créer un nouveau citoyen
        $this->renderJson(['message' => 'Citoyen créé']);
    }

    public function update($cni)
    {
        // Logique pour mettre à jour un citoyen par son CNI
        $this->renderJson(['message' => "Citoyen avec CNI: $cni mis à jour"]);
    }

    public function delete($cni)
    {
        // Logique pour supprimer un citoyen par son CNI
        $this->renderJson(['message' => "Citoyen avec CNI: $cni supprimé"]);
    }

    public function search()
    {
        // Logique pour rechercher des citoyens
        $this->renderJson(['message' => 'Recherche de citoyens']);
    }
}
