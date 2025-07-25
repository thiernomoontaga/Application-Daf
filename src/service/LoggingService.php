<?php

namespace Src\Service;

use DateTime;
use Src\Entity\Logging;
use Src\Entity\Statut;
use Src\Repository\ILoggingRepository;

class LoggingService implements ILoggingService
{
    private ILoggingRepository $loggingRepository;

    public function __construct(ILoggingRepository $loggingRepository)
    {
        $this->loggingRepository = $loggingRepository;
    }

    public function log(string $cni, string $datetime, string $ip, string $location, string $status): bool
    {
        $logEntry = new Logging();
        $logEntry->setCni($cni);
        $logEntry->setDateHeure(new DateTime($datetime));
        $logEntry->setAdresseIp($ip);
        $logEntry->setLocalisation($location);
        $logEntry->setStatut($status === 'success' ? Statut::SUCCES : Statut::ECHEC);

        return $this->loggingRepository->insert($logEntry);
    }

    public function logEntity(Logging $logEntry): bool
    {
        return $this->loggingRepository->insert($logEntry);
    }
}
