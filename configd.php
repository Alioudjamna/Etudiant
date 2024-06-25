<?php
session_start();

// Vérifier si l'utilisateur a confirmé la déconnexion
if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    session_unset();
    session_destroy();
    header('Location: index.php'); // Rediriger vers la page d'accueil après la déconnexion
    exit();
}
?>
