<?php
namespace Src\Repository;

use Src\Entity\Citoyen;

class CitoyenRepository implements ICitoyenRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByCni(string $cni): ?Citoyen
    {
        $stmt = $this->pdo->prepare("SELECT * FROM citoyens WHERE cni = :cni LIMIT 1");
        $stmt->execute(['cni' => $cni]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return Citoyen::toObject(
                $data
              
            );
        }
        return null;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM citoyens");
        $result = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = new Citoyen(
                $data['cni'],
                $data['nom'],
                $data['prenom'],
                $data['date_naissance'],
                $data['lieu_naissance'],
                $data['copie_cni'] ?? $data['copie_cni'] ?? null
            );
        }
        return $result;
    }

    }
}