<?php
namespace Src\Service;

use Src\Entity\Citoyen;

interface IcitoyenService
{
    public function rechercherCitoyen(string $cni): ?Citoyen;
    public function ajouterCitoyen(array $data): bool;
}