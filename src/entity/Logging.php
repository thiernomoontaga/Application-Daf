<?php

 namespace Src\Entity;

use DateTime;

class Citoyen{
     
   private ?DateTime $dateHeure;
   private String $localisation;
   private String $adresseIp;
   private ?Statut $statut;
   



    public function __construct( ?DateTime $dateHeure=null ,$localisation='',$adresseIp='', ?Statut $statut=null){
    $this->dateHeure = $dateHeure;
    $this->localisation= $localisation;
    $this->adresseIp = $adresseIp;
    $this->statut = $statut;

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
