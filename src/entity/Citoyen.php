<?php

namespace Src\Entity;

use App\Core\Abstract\AbstractEntity;
use DateTime;

class Citoyen extends AbstractEntity{
    private int $id;
    private string $nom;
    private string $prenom;
    private ?DateTime $dateNaissance;
    private string $lieuNaissance;
    private string $copieCin;
    
    public function __construct(
        int $id = 0, 
        string $nom = '', 
        string $prenom = '', 
        ?DateTime $dateNaissance = null, 
        string $lieuNaissance = '', 
        string $copieCin = ''
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->lieuNaissance = $lieuNaissance;
        $this->copieCin = $copieCin;
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
    
   
    public function toArray(object $data): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'dateNaissance' => $this->dateNaissance ? $this->dateNaissance->format('Y-m-d') : null,
            'lieuNaissance' => $this->lieuNaissance,
            'copieCin' => $this->copieCin
        ];
    }
    
    
    public static function toObject():static
    {
        $citoyen = new self();
        
        if (isset($data['id'])) {
            $citoyen->setId((int) $data['id']);
        }
        
        if (isset($data['nom'])) {
            $citoyen->setNom($data['nom']);
        }
        
        if (isset($data['prenom'])) {
            $citoyen->setPrenom($data['prenom']);
        }
        
        if (isset($data['dateNaissance'])) {
            if ($data['dateNaissance'] instanceof DateTime) {
                $citoyen->setDateNaissance($data['dateNaissance']);
            } elseif (is_string($data['dateNaissance']) && !empty($data['dateNaissance'])) {
                try {
                    $citoyen->setDateNaissance(new DateTime($data['dateNaissance']));
                } catch (\Exception $e) {
                    $citoyen->setDateNaissance(null);
                }
            }
        }
        
        if (isset($data['lieuNaissance'])) {
            $citoyen->setLieuNaissance($data['lieuNaissance']);
        }
        
        if (isset($data['copieCin'])) {
            $citoyen->setCopieCin($data['copieCin']);
        }
        
        return $citoyen;
    }
    
    
  
}
