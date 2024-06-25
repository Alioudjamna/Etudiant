<?php
  $servername = "localhost";
  $dbname = "gestion_etudiants";
  $dbusername = "root";
  $dbpassword = "";

  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Récupération des informations de l'étudiant sélectionné
    $selectedId = isset($_GET['id_etudiant']) ? $_GET['id_etudiant'] : '';
    $selectedInfo = array(); // Tableau pour stocker les informations de l'étudiant sélectionné

    if (!empty($selectedId)) {
        $sql = "SELECT * FROM etudiant WHERE id_etudiant = :id_etudiant";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id_etudiant' => $selectedId]);
        $selectedInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_etudiant = $_POST['id_etudiant'];
        $nouveau_nom = $_POST['nouveau_nom'];
        $nouveau_prenom = $_POST['nouveau_prenom'];
        $nouveau_sexe = $_POST['nouveau_sexe'];
        $nouveau_date_naissance = $_POST['nouveau_date_naissance'];
        $nouveau_lieu_naissance = $_POST['nouveau_lieu_naissance'];
        $nouveau_adresse = $_POST['nouveau_adresse'];
        $nouveau_ville = $_POST['nouveau_ville'];
        $nouveau_pays = $_POST['nouveau_pays'];
        $nouveau_telephone = $_POST['nouveau_telephone'];
        $nouveau_email = $_POST['nouveau_email'];
        $nouveau_annee_etude = $_POST['nouveau_annee_etude'];
        $nouveau_filieres = $_POST['nouveau_filieres'];
        $nouveau_parcours = $_POST['nouveau_parcours'];

        // Préparation de la requête SQL pour la mise à jour des informations de l'étudiant
        $sql = "UPDATE etudiant SET 
            nom = :nouveau_nom,
            prenom = :nouveau_prenom,
            sexe = :nouveau_sexe,
            date_naissance = :nouveau_date_naissance,
            lieu_naissance = :nouveau_lieu_naissance,
            adresse = :nouveau_adresse,
            ville = :nouveau_ville,
            pays = :nouveau_pays,
            telephone = :nouveau_telephone,
            email = :nouveau_email,
            annee_etude = :nouveau_annee_etude,
            id_filiere = :nouveau_filieres,
            parcours = :nouveau_parcours
            WHERE id_etudiant = :id_etudiant";

        // Liaison des paramètres
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nouveau_nom', $nouveau_nom);
        $stmt->bindParam(':nouveau_prenom', $nouveau_prenom);
        $stmt->bindParam(':nouveau_sexe', $nouveau_sexe);
        $stmt->bindParam(':nouveau_date_naissance', $nouveau_date_naissance);
        $stmt->bindParam(':nouveau_lieu_naissance', $nouveau_lieu_naissance);
        $stmt->bindParam(':nouveau_adresse', $nouveau_adresse);
        $stmt->bindParam(':nouveau_ville', $nouveau_ville);
        $stmt->bindParam(':nouveau_pays', $nouveau_pays);
        $stmt->bindParam(':nouveau_telephone', $nouveau_telephone);
        $stmt->bindParam(':nouveau_email', $nouveau_email);
        $stmt->bindParam(':nouveau_annee_etude', $nouveau_annee_etude);
        $stmt->bindParam(':nouveau_filieres', $nouveau_filieres);
        $stmt->bindParam(':nouveau_parcours', $nouveau_parcours);
        $stmt->bindParam(':id_etudiant', $id_etudiant);

        // Exécution de la requête de mise à jour et redirection si succès
        if ($stmt->execute()) {
            header('Location: liste_etudiants_modif.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour des données de l'étudiant.";
        }
    }
} catch(PDOException $e) {
    echo "Échec de la modification: " . $e->getMessage();
}
?>