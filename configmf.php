<?php
$servername = "localhost";
$dbname = "gestion_etudiants";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Échec de la connexion : ' . htmlspecialchars($e->getMessage()));
}
?>
