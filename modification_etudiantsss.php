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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
    <style>
        /* Styles CSS pour l'apparence de la page */
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            padding-bottom: 100px;
        }

        .container {
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #343a40;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #007bff;
        }

        select,
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        footer a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier un étudiant</h2>
        <form action="modification_etudiantsss.php?id_etudiant=<?php echo $selectedId; ?>" method="post">
            <input type="hidden" name="id_etudiant" value="<?php echo $selectedId; ?>">

            <label for="nouveau_nom">Nouveau nom de l'étudiant:</label><br>
            <input type="text" id="nouveau_nom" name="nouveau_nom" value="<?php echo isset($selectedInfo['nom']) ? $selectedInfo['nom'] : ''; ?>"><br>

            <label for="nouveau_prenom">Nouveau prénom de l'étudiant:</label><br>
            <input type="text" id="nouveau_prenom" name="nouveau_prenom" value="<?php echo isset($selectedInfo['prenom']) ? $selectedInfo['prenom'] : ''; ?>"><br>
            
            <label for="nouveau_sexe">Nouveau sexe de l'étudiant:</label><br>
            <select name="nouveau_sexe">
                <option value="Homme" <?php if(isset($selectedInfo['sexe']) && $selectedInfo['sexe'] == 'Homme') echo 'selected'; ?>>Homme</option>
                <option value="Femme" <?php if(isset($selectedInfo['sexe']) && $selectedInfo['sexe'] == 'Femme') echo 'selected'; ?>>Femme</option>
            </select><br>

            <label for="nouveau_date_naissance">Nouvelle date de naissance de l'étudiant:</label><br>
            <input type="date" id="nouveau_date_naissance" name="nouveau_date_naissance" value="<?php echo isset($selectedInfo['date_naissance']) ? $selectedInfo['date_naissance'] : ''; ?>"><br>

            <label for="nouveau_lieu_naissance">Nouveau lieu de naissance de l'étudiant:</label><br>
            <input type="text" id="nouveau_lieu_naissance" name="nouveau_lieu_naissance" value="<?php echo isset($selectedInfo['lieu_naissance']) ? $selectedInfo['lieu_naissance'] : ''; ?>"><br>

            <label for="nouveau_adresse">Nouvelle adresse de l'étudiant:</label><br>
            <input type="text" id="nouveau_adresse" name="nouveau_adresse" value="<?php echo isset($selectedInfo['adresse']) ? $selectedInfo['adresse'] : ''; ?>"><br>

            <label for="nouveau_ville">Nouvelle ville de l'étudiant:</label><br>
            <input type="text" id="nouveau_ville" name="nouveau_ville" value="<?php echo isset($selectedInfo['ville']) ? $selectedInfo['ville'] : ''; ?>"><br>

            <label for="nouveau_pays">Nouveau pays de l'étudiant:</label><br>
            <input type="text" id="nouveau_pays" name="nouveau_pays" value="<?php echo isset($selectedInfo['pays']) ? $selectedInfo['pays'] : ''; ?>"><br>

            <label for="nouveau_telephone">Nouveau téléphone de l'étudiant:</label><br>
            <input type="tel" id="nouveau_telephone" name="nouveau_telephone" value="<?php echo isset($selectedInfo['telephone']) ? $selectedInfo['telephone'] : ''; ?>"><br>

            <label for="nouveau_email">Nouvel email de l'étudiant:</label><br>
            <input type="email" id="nouveau_email" name="nouveau_email" value="<?php echo isset($selectedInfo['email']) ? $selectedInfo['email'] : ''; ?>"><br>

            <label for="nouveau_annee_etude">Nouvelle année d'étude de l'étudiant:</label><br>
            <input type="text" id="nouveau_annee_etude" name="nouveau_annee_etude" value="<?php echo isset($selectedInfo['annee_etude']) ? $selectedInfo['annee_etude'] : ''; ?>"><br>

            <label for="nouveau_filieres">Nouvelle filière de l'étudiant:</label><br>
            <select name="nouveau_filieres">
                <?php
                // Afficher la liste des filières à partir de la base de données
                $sql_filieres = "SELECT id_filiere, nom_filiere FROM filiere";
                $stmt_filieres = $conn->query($sql_filieres);
                while ($row_filiere = $stmt_filieres->fetch(PDO::FETCH_ASSOC)) {
                    $selected = isset($selectedInfo['id_filiere']) && $row_filiere['id_filiere'] == $selectedInfo['id_filiere'] ? 'selected' : '';
                    echo "<option value=\"" . $row_filiere['id_filiere'] . "\" $selected>" . $row_filiere['nom_filiere'] . "</option>";
                }
                ?>
            </select><br>

            <label for="nouveau_parcours">Nouveau parcours de l'étudiant:</label><br>
            <select name="nouveau_parcours">
                <option value="licence" <?php if(isset($selectedInfo['parcours']) && $selectedInfo['parcours'] == 'licence') echo 'selected'; ?>>Licence</option>
                <option value="master" <?php if(isset($selectedInfo['parcours']) && $selectedInfo['parcours'] == 'master') echo 'selected'; ?>>Master</option>
                <option value="doctorat" <?php if(isset($selectedInfo['parcours']) && $selectedInfo['parcours'] == 'doctorat') echo 'selected'; ?>>Doctorat</option>
            </select><br>

            <input type="submit" class="btn-primary" value="Modifier">
        </form>
    </div>
    <footer>
        <p>© 2023 Projet Gestion des Étudiants</p>
        <div>
            <a href="accueil.php">Accueil</a>
            <a href="admin.php">Admin</a>
            <a href="ajout_etudiant.php">Ajouter Étudiant</a>
            <a href="liste_etudiants.php">Liste Étudiants</a>
            <a href="ajout_filiere.php">Ajouter Filière</a>
            <a href="liste_filieres.php">Liste Filières</a>
            <a href="liste_etudiants_modif.php">Modification étudiant</a>
            <a href="modification_filiere.php">Modification filière</a>
        </div>
    </footer>
</body>
</html>
