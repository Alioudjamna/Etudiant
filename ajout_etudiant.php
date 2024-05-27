<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header('Location: connexion.php');
    exit();
}

// Connexion à la base de données (ajustez les paramètres selon votre configuration)
$pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer la liste des filières depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM filiere");
$stmt->execute();
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire d'ajout d'étudiant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous de valider et d'ajouter les informations de l'étudiant dans votre base de données
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $adresse = $_POST['adresse'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $annee_etude = $_POST['annee_etude'];
    $parcours = $_POST['parcours'];
    
    // Vérifier si la filière est définie dans $_POST
    $id_filiere = null;
    if (isset($_POST['filieres'])) {
        $filiere = $_POST['filieres'];

        // Recherche de l'ID de la filière en fonction de son nom
        $stmt = $pdo->prepare("SELECT id_filiere FROM filiere WHERE nom_filiere = :nom_filiere");
        $stmt->bindParam(':nom_filiere', $filiere);
        $stmt->execute();
        $id_filiere = $stmt->fetchColumn();
    }

    // Vérifier si l'étudiant existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE nom = :nom AND prenom = :prenom");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Rediriger avec un message d'erreur si l'étudiant existe déjà
        header('Location: ajout_etudiant.php?error=exists');
        exit();
    } else {
        // Ajouter l'étudiant dans la base de données
        $stmt = $pdo->prepare("INSERT INTO etudiant (nom, prenom, sexe, date_naissance, lieu_naissance, adresse, pays, ville, telephone, email, annee_etude, parcours, id_filiere) VALUES (:nom, :prenom, :sexe, :date_naissance, :lieu_naissance, :adresse, :pays, :ville, :telephone, :email, :annee_etude, :parcours, :id_filiere)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':lieu_naissance', $lieu_naissance);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':pays', $pays);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':annee_etude', $annee_etude);
        $stmt->bindParam(':parcours', $parcours);
        $stmt->bindParam(':id_filiere', $id_filiere);
        $stmt->execute();

        // Rediriger après l'ajout
        header('Location: liste_etudiants.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Étudiant</title>
    <style>
                body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 600px;
            box-sizing: border-box;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            width: 100%;
            position: fixed;
            bottom: 0;
            z-index: 2;
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

        footer div {
            display: flex;
            justify-content: center;
        }

        #change-bg {
            color: #007bff;
            cursor: pointer;
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dcdcdc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <!-- Formulaire d'ajout d'étudiant -->
    <form action="" method="post">
        <h2>Formulaire d'Ajout Étudiant</h2>

        <?php if (!empty($error_message)): ?>
            <!-- Afficher le message d'erreur s'il existe -->
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="date_naissance">Date de Naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required>

        <label for="lieu_naissance">Lieu de Naissance :</label>
        <input type="text" id="lieu_naissance" name="lieu_naissance" required>

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" required>

        <label for="pays">Pays :</label>
        <input type="text" id="pays" name="pays" required>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe" required>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="annee_etude">Année d'Étude :</label>
        <input type="text" id="annee_etude" name="annee_etude" required>

        <label for="filieres">Filières Choisies :</label>
            <select id="filieres" name="filieres" required>
                <?php
                // Utiliser un tableau associatif pour suivre les filières déjà affichées
                $filiere_affichees = array();

                foreach ($filieres as $filiere):
                    if (!in_array($filiere['nom_filiere'], $filiere_affichees)):
                        $filiere_affichees[] = $filiere['nom_filiere'];
                ?>
                        <option value="<?php echo $filiere['nom_filiere']; ?>"><?php echo $filiere['nom_filiere']; ?></option>
                <?php
                    endif;
                endforeach;
                ?>
            </select>

        <label for="parcours">Parcours :</label>
        <select id="parcours" name="parcours" required>
            <option value="licence">Licence</option>
            <option value="master">Master</option>
            <option value="doctorat">Doctorat</option>
        </select>

        <button type="submit">Ajouter Étudiant</button>
    </form>

    <footer>
        <p>© 2023 Projet Gestion des Étudiants</p>
        <div>
            <a href="accueil.php">Accueil</a>
            <a href="admin.php">Admin</a>
            <a href="ajout_etudiant.php">Ajouter Étudiant</a>
            <a href="liste_etudiants.php">Liste Étudiants</a>
            <a href="ajout_filiere.php">Ajouter Filière</a>
            <a href="liste_filieres.php">Liste Filières</a>
            <a href="liste_etudiants_modif.php">Modification Étudiant</a>
            <a href="modification_filiere.php">Modification Filière</a>
        </div>
    </footer>

    <div id="change-bg" onclick="changeBackground()">Changer le fond d'écran</div>

    <script>
        function validateForm() {
            // Ajoutez des validations personnalisées si nécessaire
            return true;
        }

        function changeBackground() {
            // Ajoutez ici la logique pour changer le fond d'écran
            alert('Fonctionnalité à implémenter');
        }
    </script>

</body>
</html>
