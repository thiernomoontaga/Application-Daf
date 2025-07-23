INSERT INTO citoyens (cni, nom, prenom, date_naissance, lieu_naissance, copie_cni) VALUES
('1234567890123457', 'DIALLO', 'Mamadou', '1990-05-15', 'Dakar', 'https://example-cloud-storage.com/cartes/1234567890123456.jpg'),
('2345678901234567', 'FALL', 'Fatou', '1985-12-03', 'Saint-Louis', 'https://example-cloud-storage.com/cartes/2345678901234567.jpg'),
('3456789012345678', 'NDIAYE', 'Ousmane', '1992-08-20', 'Thiès', 'https://example-cloud-storage.com/cartes/3456789012345678.jpg'),
('4567890123456789', 'SARR', 'Aïssatou', '1988-03-10', 'Kaolack', 'https://example-cloud-storage.com/cartes/4567890123456789.jpg'),
('5678901234567890', 'BA', 'Ibrahima', '1995-11-25', 'Ziguinchor', 'https://example-cloud-storage.com/cartes/5678901234567890.jpg'),
('6789012345678901', 'SECK', 'Aminata', '1993-07-08', 'Diourbel', 'https://example-cloud-storage.com/cartes/6789012345678901.jpg'),
('7890123456789012', 'GUEYE', 'Moussa', '1987-01-30', 'Louga', 'https://example-cloud-storage.com/cartes/7890123456789012.jpg'),
('8901234567890123', 'KANE', 'Khadija', '1991-09-12', 'Matam', 'https://example-cloud-storage.com/cartes/8901234567890123.jpg'),
('9012345678901234', 'THIAM', 'Cheikh', '1989-04-25', 'Kolda', 'https://example-cloud-storage.com/cartes/9012345678901234.jpg'),
('0123456789012345', 'WADE', 'Marieme', '1994-11-18', 'Sédhiou', 'https://example-cloud-storage.com/cartes/0123456789012345.jpg');

INSERT INTO logging (cni_recherche, localisation, adresse_ip, statut) VALUES
('1234567890123458', 'Dakar', '192.168.1.100', 'Reussie'),
('2345678901234567', 'Saint-Louis', '192.168.1.101', 'Reussie'),
('9999999999999999', 'Thiès', '192.168.1.102', 'Echec'),
('3456789012345678', 'Kaolack', '192.168.1.103', 'Reussie'),
('1111111111111111', 'Ziguinchor', '192.168.1.104', 'Echec'),
('4567890123456789', 'Diourbel', '192.168.1.105', 'Reussie'),
('8888888888888888', 'Louga', '192.168.1.106', 'Echec'),
('5678901234567890', 'Matam', '192.168.1.107', 'Reussie');

SELECT 'Nombre de citoyens:' as info, COUNT(*) as total FROM citoyens
UNION ALL
SELECT 'Nombre de logs:' as info, COUNT(*) as total FROM logging
UNION ALL
SELECT 'Recherches réussies:' as info, COUNT(*) as total FROM logging WHERE statut = 'Reussie'
UNION ALL
SELECT 'Recherches échouées:' as info, COUNT(*) as total FROM logging WHERE statut = 'Echec';