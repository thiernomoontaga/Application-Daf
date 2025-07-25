-- Création de la table citoyens
CREATE TABLE IF NOT EXISTS citoyens (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    cni VARCHAR(20) UNIQUE NOT NULL,
    date_naissance DATE NOT NULL,
    lieu_naissance VARCHAR(200) NOT NULL,
    copie_cni TEXT, -- URL de l'image
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table logs pour la journalisation
CREATE TABLE IF NOT EXISTS search_logs (
    id SERIAL PRIMARY KEY,
    cni VARCHAR(20) NOT NULL,
    ip_address INET NOT NULL,
    date_recherche TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    localisation VARCHAR(200),
    statut VARCHAR(50) NOT NULL,
    user_agent TEXT
);

-- Insertion de quelques données de test
INSERT INTO citoyens (nom, prenom, cni, date_naissance, lieu_naissance, copie_cni) VALUES
('DIOP', 'Amadou', '1234567890123', '1990-05-15', 'Dakar', 'https://example.com/cni/1234567890123.jpg'),
('FALL', 'Fatou', '2345678901234', '1985-08-22', 'Saint-Louis', 'https://example.com/cni/2345678901234.jpg'),
('NDIAYE', 'Moussa', '3456789012345', '1992-12-10', 'Thiès', 'https://example.com/cni/3456789012345.jpg');

-- Index pour optimiser les recherches
CREATE INDEX idx_cni ON citoyens(cni);
CREATE INDEX idx_search_logs_cni ON search_logs(cni);
CREATE INDEX idx_search_logs_date ON search_logs(date_recherche);