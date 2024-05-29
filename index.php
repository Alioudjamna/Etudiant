<?php
 session_start();

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $identifiant = isset($_POST['identifiant']) ? $_POST['identifiant'] : '';
        $motdepasse = isset($_POST['motdepasse']) ? $_POST['motdepasse'] : '';

        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($motdepasse, $user['motdepasse'])) {
            $_SESSION['identifiant'] = $user['identifiant'];
            $_SESSION['profil'] = $user['profil'];

            // Redirection vers la page d'accueil
            header('Location: accueil.php');
            exit();
        } else {
            $erreur = 'Identifiant ou mot de passe incorrect.';
        }
    } catch (PDOException $e) {
        $erreur = 'Erreur de connexion : ' . $e->getMessage();
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <!-- Liens Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .gestion-etudiants {
            font-size: 39px; /* Taille de police personnalisée */
            font-weight: bold; /* Gras pour un aspect plus important */
        }

        body {
            background-image: url('imageconnexion.jpg'); /* Remplacez 'votre_image.jpg' par le nom de votre image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: reverse;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .overlay {
            display: flex;
            position: absolute; 
            background-color: rgba(0, 0, 0, 0.5); /* Ajustez la transparence en modifiant le dernier paramètre */
        }

        .containera {
            position: center;
            z-index: 1;
            max-width: 400px;
            padding: 20px;
            margin: 5px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .containerb {
            position: center;
            z-index: 1;
            max-width: 400px;
            padding: 20px;
            margin: 5px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        @media screen and (max-width: 440px){
            body{
                flex-direction: column-reverse;
            }
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        form {
            margin-top: 20px;
        }

        form label {
            font-weight: bold;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        .erreur {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .welcome-box {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

    </style>

    <script>
        $(document).ready(function () {
            // Ajoutez ici le code JavaScript pour des fonctionnalités supplémentaires si nécessaire
        });
    </script>
</head>
<body>
    <div class="overlay"></div>
    <div class="containera">
        <h2>Connexion</h2>

        <!-- Afficher les erreurs éventuelles -->
        <?php if (isset($erreur)) : ?>
            <p class="erreur"><?= $erreur; ?></p>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form action="" method="post">
            <div class="form-group">
                <label for="identifiant">Identifiant:</label>
                <input type="text" class="form-control" id="identifiant" name="identifiant" required>
            </div>

            <div class="form-group">
                <label for="motdepasse">Mot de passe:</label>
                <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Se Connecter</button>
        </form>

        <p class="mt-3"><small>Vous n'avez pas de compte? <a href="inscription.php">Inscrivez-vous ici</small></a></p>
    </div>

    <div class="containerb">
        <!-- Message de bienvenue dans un cadre bleu -->
        <div class="welcome-box bg-primary text-white p-4 mb-4">
            <p class="mb-0">
                Bienvenue dans<br> <B>Gestion_Etudiants</B> <br> L'application révolutionnaire de gestion des étudiants.
            </p>
        </div>
    </div>

</body>
</html>
