<?php
namespace App\Entity;

class Citoyen
{
    public string $nci;
    public string $nom;
    public string $prenom;
    public string $dateNaissance;
    public string $lieuNaissance;
    public string $urlCopieCni;

    public function toArray(): array
    {
        return [
            'nci' => $this->nci,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'date' => $this->dateNaissance,
            'lieu' => $this->lieuNaissance,
            'copie' => $this->urlCopieCni
        ];
    }
}
