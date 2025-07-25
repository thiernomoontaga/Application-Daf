<?php

namespace Src\Service;

use DateTime;
use Src\Entity\Logging;
use Src\Entity\Statut;

interface ILoggingService
{
    public function log(string $cni, string $datetime, string $ip, string $location, string $status): bool;
    public function logEntity(Logging $logEntry): bool;
}
