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

// Traitement du formulaire d'ajout de filière
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous de valider et d'ajouter les informations de la filière dans votre base de données
    $nom_filiere = $_POST['nom_filiere'];
    // Ajoutez d'autres champs selon vos besoins

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM filiere WHERE nom_filiere = :nom_filiere");
    $stmt->bindParam(':nom_filiere', $nom_filiere);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Afficher un message d'erreur si la filière existe déjà
        $error_message = "Cette filière existe déjà.";
    } else {
        // Ajouter la nouvelle filière dans la base de données
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assurez-vous de valider et d'ajouter les informations de la filière dans votre base de données
            $nom_filiere = $_POST['nom_filiere'];
            // Ajoutez d'autres champs selon vos besoins
        
            // Ajouter la nouvelle filière dans la base de données
            $stmt = $pdo->prepare("INSERT INTO filiere (nom_filiere) VALUES (:nom_filiere)");
            $stmt->bindParam(':nom_filiere', $nom_filiere);
            $stmt->execute();
        
            // Rediriger après l'ajout
            header('Location: liste_filieres.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une filière</title>
    <style>
    body {
        background-color: #f8f9fa; /* Couleur de fond */
    }

    .container {
        background-color: #ffffff; /* Couleur du conteneur */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
        padding: 20px;
        margin-top: 50px;
    }

    h2 {
        color: #007bff; /* Couleur du titre */
        text-align: center;
    }

    form {
        max-width: 400px; /* Largeur maximale du formulaire */
        margin: auto;
    }

    label {
        font-weight: bold;
        color: #495057; /* Couleur du texte du label */
    }

    .form-control {
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff; /* Couleur du bouton */
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Couleur du bouton au survol */
    }

    .error-message {
        color: red;
        font-weight: bold;
        text-align: center;
    }

    footer {
        background-color: #333;
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

    footer div {
        display: flex;
        justify-content: center;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Ajout d'une filière</h2>

        <?php if ($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="nom_filiere">Nom de la filière:</label>
            <input type="text" name="nom_filiere" required><br>

            <!-- Ajoutez d'autres champs selon vos besoins -->

            <input type="submit" value="Ajouter" class="btn-primary">
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
        <a href="liste_etudiants_modif.php">Modification Étudiant</a>
        <a href="modification_filiere.php">Modification Filière</a>
    </div>
</footer>
</body>
</html>
