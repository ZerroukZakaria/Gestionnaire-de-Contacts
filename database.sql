-- Gestionnaire de Contacts
-- Structure de la base de données + données de test

CREATE DATABASE IF NOT EXISTS gestion_contacts;
USE gestion_contacts;

-- Table contacts
CREATE TABLE IF NOT EXISTS contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE,
    telephone VARCHAR(20),
    adresse TEXT,
    date_naissance DATE,
    notes TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Données de test
INSERT INTO contacts 
(nom, prenom, email, telephone, date_naissance, adresse, notes)
VALUES
('El Amrani', 'Youssef', 'youssef.elamrani@gmail.com', '0612345678', '1998-03-12', 'Casablanca, Bourgogne', 'Client fidèle'),
('Benali', 'Sara', 'sara.benali@yahoo.com', '0623456789', '2000-07-25', 'Rabat, Agdal', 'Préférer contact par email'),
('Alaoui', 'Karim', 'karim.alaoui@outlook.com', '0634567890', '1995-11-02', 'Marrakech, Guéliz', 'Disponible le matin'),
('Chakiri', 'Imane', 'imane.chakiri@gmail.com', '0645678901', '1999-01-18', 'Fès, Route Imouzzer', 'Étudiante'),
('Tahiri', 'Omar', 'omar.tahiri@gmail.com', '0656789012', '1993-06-30', 'Tanger, Malabata', 'Client entreprise'),
('Zahraoui', 'Khadija', 'khadija.zahraoui@yahoo.fr', '0667890123', '1988-09-09', 'Salé, Bettana', 'Ancienne cliente'),
('Bouazza', 'Anas', 'anas.bouazza@gmail.com', '0678901234', '1997-04-21', 'Kénitra, Maamora', 'Contact WhatsApp'),
('El Idrissi', 'Nadia', 'nadia.elidrissi@live.com', '0689012345', '1992-12-14', 'Meknès, Hamria', 'Très réactive'),
('Sbaa', 'Hicham', 'hicham.sbaa@gmail.com', '0690123456', '1985-02-05', 'Oujda, Centre-ville', 'Responsable logistique'),
('Berrada', 'Asmae', 'asmae.berrada@gmail.com', '0601234567', '2001-08-27', 'Tétouan, Wilaya', 'Nouvelle cliente'),

('Laraki', 'Mehdi', 'mehdi.laraki@gmail.com', '0611122233', '1996-05-10', 'Casablanca, Maarif', 'Rendez-vous mensuel'),
('Kabbaj', 'Meriem', 'meriem.kabbaj@gmail.com', '0622233344', '1994-10-03', 'Rabat, Hay Riad', 'Facturation annuelle'),
('Skalli', 'Amine', 'amine.skalli@yahoo.com', '0633344455', '1989-01-29', 'Fès, Narjiss', 'Contact téléphonique'),
('Raji', 'Salma', 'salma.raji@gmail.com', '0644455566', '2002-06-17', 'Agadir, Talborjt', 'Étudiante stagiaire'),
('Ouahbi', 'Yassine', 'yassine.ouahbi@gmail.com', '0655566677', '1990-09-08', 'Safi, Plateau', 'Disponibilité limitée'),
('Haddadi', 'Ilham', 'ilham.haddadi@outlook.com', '0666677788', '1998-12-22', 'Béni Mellal, Centre', 'À rappeler'),
('Benkirane', 'Rachid', 'rachid.benkirane@gmail.com', '0677788899', '1983-07-19', 'Mohammedia, Parc', 'Contact prioritaire'),
('Amine', 'Sofia', 'sofia.amine@gmail.com', '0688899900', '1997-03-03', 'El Jadida, Centre', 'Cliente VIP'),
('Qasmi', 'Hamza', 'hamza.qasmi@yahoo.com', '0699900011', '2000-11-11', 'Nador, Corniche', 'Intéressé par offre'),
('Fadili', 'Hanane', 'hanane.fadili@gmail.com', '0609988776', '1991-04-26', 'Settat, Hay Salam', 'Suivi trimestriel');

