<?php

namespace Src\Repository;

use PDO;
use Src\Entity\Citoyen;
use App\Core\Database;

class CitoyenRepository implements ICitoyenRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findByCni(string $cni): ?Citoyen
    {
        $stmt = $this->pdo->prepare("SELECT * FROM citoyens WHERE cni = :cni LIMIT 1");
        $stmt->execute(['cni' => $cni]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return Citoyen::toObject($data);
        }
        return null;
    }

    public function findAll(array $filters): array
    {
        $limit = $filters['limit'] ?? 10;
        $offset = $filters['offset'] ?? 0;

        $stmt = $this->pdo->prepare("SELECT * FROM citoyens LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $result = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // Retourner directement les données pour éviter les problèmes d'entité pour l'instant
            $result[] = $data;
        }
        return $result;
    }
    public function insert($citoyen): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO citoyens (cni, nom, prenom, date_naissance, lieu_naissance, copie_cni) VALUES (:cni, :nom, :prenom, :date_naissance, :lieu_naissance, :copie_cni)");
        $stmt->execute([
            'cni' => $citoyen->getCni(),
            'nom' => $citoyen->getNom(),
            'prenom' => $citoyen->getPrenom(),
            'date_naissance' => $citoyen->getDateNaissance(),
            'lieu_naissance' => $citoyen->getLieuNaissance(),
            'copie_cni' => $citoyen->getCopieCni()
        ]);
        return $this->pdo->lastInsertId();
    }
}
