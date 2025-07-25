<?php

 namespace Src\Entity;

use DateTime;

class Citoyen{
     
    private int $id;
    private String $nom;
    private String $prenom;
    private ?DateTime $dateNaissance;
    private String $lieuNaissance;
    private String $copieCin;




    public function __construct( int $id = 0, string $nom='', string $prenom='', ?DateTime $dateNaissance=null,  string $lieuNaissance='' , string $copieCin=''){
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->dateNaissance = $dateNaissance;
    $this->copieCin = $copieCin;
  }
   public static function toObject(array $data): self
    {
        $citoyen = new self();
        $citoyen->setId($data['id'] ?? 0);
        $citoyen->setNom($data['nom'] ?? '');
        $citoyen->setPrenom($data['prenom'] ?? '');
        $citoyen->setDateNaissance(isset($data['date_naissance']) ? new DateTime($data['date_naissance']) : null);
        $citoyen->setLieuNaissance($data['lieu_naissance'] ?? '');
        $citoyen->setCopieCin($data['copie_cin'] ?? '');
        return $citoyen;
    }

                public function getId(): int
                {
                    return $this->id;
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

                public function getCopieCin(): string
                {
                    return $this->copieCin;
                }

                public function setId(int $id): self
                {
                    $this->id = $id;
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

                public function setCopieCin(string $copieCin): self
                {
                    $this->copieCin = $copieCin;
                    return $this;
                }
                }
