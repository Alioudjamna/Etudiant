<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header('Location: connexion.php');
    exit();
}

// Connexion à la base de données (ajustez les paramètres selon votre configuration)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
