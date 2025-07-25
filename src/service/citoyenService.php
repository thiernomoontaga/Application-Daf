<?php
namespace Src\Service;

use Src\Entity\Citoyen;
use Src\Repository\ICitoyenRepository;

class CitoyenService implements IcitoyenService
{
    private ICitoyenRepository $repository;

    public function __construct(ICitoyenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function rechercherCitoyen(string $cni): ?Citoyen
    {
        return $this->repository->findByCni($cni);
    }

    // public function ajouterCitoyen(array $data): bool
    // {
    //     $citoyen = new Citoyen(
    //         $data['cni'],
    //         $data['nom'],
    //         $data['prenom'],
    //         $data['date_naissance'],
    //         $data['lieu_naissance'],
    //         $data['copie_cni'] ?? null
    //     );
    //     return $this->repository->save($citoyen);
    // }
}
