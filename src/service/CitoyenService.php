<?php

namespace Src\Service;

use Src\Entity\Citoyen;
use Src\Repository\ICitoyenRepository;

class CitoyenService implements ICitoyenService
{
    private ICitoyenRepository $citoyenRepository;

    public function __construct(ICitoyenRepository $citoyenRepository)
    {
        $this->citoyenRepository = $citoyenRepository;
    }

    public function getCitoyenByCni(string $cni): ?Citoyen
    {
        return $this->citoyenRepository->findByCni($cni);
    }

    public function getAllCitoyens(array $filters): array
    {
        return $this->citoyenRepository->findAll($filters);
    }
}
