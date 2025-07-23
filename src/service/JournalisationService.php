<?php 

namespace App\Service;

class JournalisationService
{
    public function logRecherche(string $nci, bool $success): void
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'inconnu';
        $statut = $success ? 'Success' : 'Échec';
        $date = date('Y-m-d H:i:s');

        $log = "$date | IP: $ip | NCI: $nci | Statut: $statut\n";
        file_put_contents(__DIR__ . '/../log/recherches.log', $log, FILE_APPEND);
    }
}
