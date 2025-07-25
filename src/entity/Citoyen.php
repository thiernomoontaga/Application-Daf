<?php

namespace Src\Entity;

use DateTime;

class Citoyen
{

    private int $id;
    private string $cni;
    private string $nom;
    private string $prenom;
    private ?DateTime $dateNaissance;
    private string $lieuNaissance;
    private ?string $copieCni;

    public function __construct(
        int $id = 0,
        string $cni = '',
        string $nom = '',
        string $prenom = '',
        ?DateTime $dateNaissance = null,
        string $lieuNaissance = '',
        ?string $copieCni = null
    ) {
        $this->id = $id;
        $this->cni = $cni;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->lieuNaissance = $lieuNaissance;
        $this->copieCni = $copieCni;
    }

    public static function toObject(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['cni'] ?? '',
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            isset($data['date_naissance']) ? new DateTime($data['date_naissance']) : null,
            $data['lieu_naissance'] ?? '',
            $data['copie_cni'] ?? null
        );
    }

    public static function toArray(self $citoyen): array
    {
        return [
            'id' => $citoyen->getId(),
            'cni' => $citoyen->getCni(),
            'nom' => $citoyen->getNom(),
            'prenom' => $citoyen->getPrenom(),
            'date_naissance' => $citoyen->getDateNaissance() ? $citoyen->getDateNaissance()->format('Y-m-d') : null,
            'lieu_naissance' => $citoyen->getLieuNaissance(),
            'copie_cni' => $citoyen->getCopieCni()
        ];
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getCni(): string
    {
        return $this->cni;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getDateNaissance(): ?DateTime
    {
        return $this->dateNaissance;
    }

    public function getLieuNaissance(): string
    {
        return $this->lieuNaissance;
    }

    public function getCopieCni(): ?string
    {
        return $this->copieCni;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setCni(string $cni): self
    {
        $this->cni = $cni;
        return $this;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function setDateNaissance(?DateTime $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;
        return $this;
    }

    public function setCopieCni(?string $copieCni): self
    {
        $this->copieCni = $copieCni;
        return $this;
    }
}
