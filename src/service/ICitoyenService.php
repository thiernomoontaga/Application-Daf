<?php
namespace Src\Service;

use Src\Entity\Citoyen;

interface ICitoyenService
{
    public function getCitoyenByCni(string $cni): ?Citoyen;
    public function getAllCitoyens(array $filters): array;
    // public function addCitoyen(array $data): bool;
}