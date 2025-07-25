-- Script de création des tables pour PostgreSQL

-- Création du type énumération pour le statut de logging
CREATE TYPE statut_type AS ENUM ('Succes', 'Echec');

-- Table des citoyens
CREATE TABLE IF NOT EXISTS citoyens (
    id SERIAL PRIMARY KEY,
    cni VARCHAR(20) UNIQUE,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE,
    lieu_naissance VARCHAR(255),
    copie_cni VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table de logging
CREATE TABLE IF NOT EXISTS logging (
    id SERIAL PRIMARY KEY,
    cni VARCHAR(20) NOT NULL,
    date_heure TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    adresse_ip INET,
    localisation VARCHAR(255),
    statut statut_type NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Index pour optimiser les recherches
CREATE INDEX IF NOT EXISTS idx_citoyens_cni ON citoyens(cni);
CREATE INDEX IF NOT EXISTS idx_logging_cni ON logging(cni);
CREATE INDEX IF NOT EXISTS idx_logging_date ON logging(date_heure);

-- Données de test (optionnel)
INSERT INTO citoyens (cni, nom, prenom, date_naissance, lieu_naissance) 
VALUES 
    ('12345678901', 'DIOP', 'Moussa', '1990-01-15', 'Dakar'),
    ('98765432109', 'FALL', 'Aminata', '1985-07-22', 'Thiès'),
    ('11223344556', 'NDIAYE', 'Ibrahima', '1992-03-10', 'Saint-Louis')
ON CONFLICT (cni) DO NOTHING;

COMMIT;
