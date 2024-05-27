-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_etudiants;

-- Utilisation de la base de données
USE gestion_etudiants;

-- Création de la table filiere
CREATE TABLE IF NOT EXISTS filiere (
    id_filiere INT AUTO_INCREMENT PRIMARY KEY,
    nom_filiere VARCHAR(255) NOT NULL
);

-- Création de la table etudiant
CREATE TABLE IF NOT EXISTS etudiant (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    lieu_naissance VARCHAR(255) NOT NULL,
    sexe VARCHAR(10) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(255) NOT NULL,
    pays VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    parcours VARCHAR(255) NOT NULL,
    niveau_etudes VARCHAR(50) NOT NULL,
    id_filiere INT,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
);

-- Création de la table utilisateur
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    identifiant VARCHAR(255) NOT NULL,
    motdepasse VARCHAR(255) NOT NULL,
    profil ENUM('administrateur', 'invite') NOT NULL
);
