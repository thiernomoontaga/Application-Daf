<?php

namespace Src\Entity;

use DateTime;

class Logging
{
    private int $id;
    private string $cni;
    private ?DateTime $dateHeure;
    private String $localisation;
    private String $adresseIp;
    private ?Statut $statut;

    public function __construct(int $id = 0, string $cni = '', ?DateTime $dateHeure = null, $localisation = '', $adresseIp = '', ?Statut $statut = null)
    {
        $this->id = $id;
        $this->cni = $cni;
        $this->dateHeure = $dateHeure;
        $this->localisation = $localisation;
        $this->adresseIp = $adresseIp;
        $this->statut = $statut;
    }

    public static function toObject(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['cni'] ?? '',
            isset($data['date_heure']) ? new DateTime($data['date_heure']) : null,
            $data['localisation'] ?? '',
            $data['adresse_ip'] ?? '',
            isset($data['statut']) ? Statut::from($data['statut']) : null
        );
    }

    public static function toArray(self $logging): array
    {
        return [
            'id' => $logging->getId(),
            'cni' => $logging->getCni(),
            'date_heure' => $logging->getDateHeure() ? $logging->getDateHeure()->format('Y-m-d H:i:s') : null,
            'localisation' => $logging->getLocalisation(),
            'adresse_ip' => $logging->getAdresseIp(),
            'statut' => $logging->getStatut() ? $logging->getStatut()->value : ''
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCni(): string
    {
        return $this->cni;
    }
    public function setCni(string $cni): self
    {
        $this->cni = $cni;
        return $this;
    }
    public function getDateHeure(): ?DateTime
    {
        return $this->dateHeure;
    }

    public function getLocalisation(): string
    {
        return $this->localisation;
    }

    public function getAdresseIp(): string
    {
        return $this->adresseIp;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setDateHeure(?DateTime $dateHeure): self
    {
        $this->dateHeure = $dateHeure;
        return $this;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;
        return $this;
    }

    public function setAdresseIp(string $adresseIp): self
    {
        $this->adresseIp = $adresseIp;
        return $this;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;
        return $this;
    }
}
