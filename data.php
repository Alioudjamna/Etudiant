<?php
// Inclure votre fichier de configuration pour la base de données
include 'configset.php';

// Requête pour obtenir le nombre d'étudiants par filière en joignant les tables 'etudiant' et 'filiere'
$query = "SELECT f.nom_filiere AS filiere, COUNT(e.id_etudiant) AS count
          FROM etudiant e
          JOIN filiere f ON e.id_filiere = f.id_filiere
          GROUP BY f.nom_filiere";

// Exécuter la requête et vérifier s'il y a des erreurs
$result = $conn->query($query);
if (!$result) {
    die("Erreur lors de l'exécution de la requête: " . $conn->error);
}

$data = [];
$labels = [];
$values = [];

// Vérifier si le résultat est valide avant de l'utiliser
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['filiere'];
        $values[] = $row['count'];
    }
} else {
    // Gérer le cas où il n'y a pas de résultats
    echo json_encode(['error' => 'Aucun résultat trouvé']);
    exit;
}

// Renvoi des données au format JSON
echo json_encode(['labels' => $labels, 'values' => $values]);
?>
