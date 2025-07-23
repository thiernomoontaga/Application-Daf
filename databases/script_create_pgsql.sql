CREATE TYPE statut_recherche AS ENUM ('Reussie', 'Echec');

CREATE TABLE IF NOT EXISTS citoyens (
    id SERIAL PRIMARY KEY,
    cni VARCHAR(20) UNIQUE NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    lieu_naissance VARCHAR(100) NOT NULL,
    copie_cni VARCHAR(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS logging (
    id SERIAL PRIMARY KEY,
    cni_recherche VARCHAR(20) NOT NULL,
    date_recherche TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    localisation VARCHAR(100),
    adresse_ip VARCHAR(45) NOT NULL,
    statut statut_recherche NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_citoyens_cni ON citoyens(cni);
