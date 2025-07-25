-- Script de création des tables pour PostgreSQL

-- Suppression des objets existants pour recréation propre
DROP TABLE IF EXISTS logging CASCADE;
DROP TABLE IF EXISTS citoyens CASCADE;
DROP TYPE IF EXISTS statut_type CASCADE;

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
