<?php

namespace Src\Repository;

use Src\Entity\Citoyen;

interface ICitoyenRepository
{
    public function findByCni(string $cni): ?Citoyen;
    public function findAll(): array;
 
}


