<?php

namespace Src\Repository;

use App\Core\Abstract\IRepository;
use Src\Entity\Citoyen;

interface ICitoyenRepository extends IRepository {
    public function findByCni(string $cni): ?Citoyen;
}


