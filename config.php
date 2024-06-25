<?php
// config.php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header('Location: connexion.php');
    exit();
}

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
    exit();
}

// Préparez et exécutez la requête SQL pour récupérer l'email
$stmt = $pdo->prepare("SELECT email FROM utilisateur WHERE identifiant = :identifiant");
$stmt->bindParam(':identifiant', $_SESSION['identifiant']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Assurez-vous que la requête a retourné des résultats
$emailUtilisateur = $result ? $result['email'] : "Adresse email non disponible";

// Enregistrez l'heure de connexion dans la session si elle n'existe pas encore
if (!isset($_SESSION['heure_connexion'])) {
    $_SESSION['heure_connexion'] = time();
}
?>
