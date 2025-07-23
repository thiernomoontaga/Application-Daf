<?php
namespace Src\Entity;

use App\Core\Abstract\AbstractEntity ;
use DateTime;

class Logging extends AbstractEntity{
    private ?DateTime $dateHeure;
    private string $localisation;
    private string $adresseIp;
    private ?Statut $statut;
    private string $cni;
    
    public function __construct(
        ?DateTime $dateHeure = null,
        string $localisation = '',
        string $adresseIp = '',
        ?Statut $statut = null,
        string $cni = ''
    ) {
        $this->dateHeure = $dateHeure;
        $this->localisation = $localisation;
        $this->adresseIp = $adresseIp;
        $this->statut = $statut;
        $this->cni = $cni;
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

            public function getCni(): string
        {
            return $this->cni;
        }

        public function setCni(string $cni): self
        {
            $this->cni = $cni;
            return $this;
        }

    
   
    public function toArray(object $data): array
    {
        return [
            'dateHeure' => $this->dateHeure ? $this->dateHeure->format('Y-m-d H:i:s') : null,
            'localisation' => $this->localisation,
            'adresseIp' => $this->adresseIp,
            'statut' => $this->statut ,
            'cni' => $this->cni 
        ];
    }
    
    
    public static function toObject():static
    {
        $logging = new self();
        
        if (isset($data['dateHeure'])) {
            if ($data['dateHeure'] instanceof DateTime) {
                $logging->setDateHeure($data['dateHeure']);
            } elseif (is_string($data['dateHeure']) && !empty($data['dateHeure'])) {
                try {
                    $logging->setDateHeure(new DateTime($data['dateHeure']));
                } catch (\Exception $e) {
                    $logging->setDateHeure(null);
                }
            }
        }
        
        if (isset($data['localisation'])) {
            $logging->setLocalisation($data['localisation']);
        }
        
        if (isset($data['adresseIp'])) {
            $logging->setAdresseIp($data['adresseIp']);
        }
        
        if (isset($data['statut'])) {
            if ($data['statut'] instanceof Statut) {
                $logging->setStatut($data['statut']);
            } elseif (is_array($data['statut'])) {
                // $logging->setStatut(Statut::toObject());
            }
        }
        
        return $logging;
    }
    
    
}

