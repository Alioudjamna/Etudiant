<?php
include 'configaf.php';

// Traitement du formulaire d'ajout de filière
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_filiere = $_POST['nom_filiere'];

    // Vérifier si la filière existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM filiere WHERE nom_filiere = :nom_filiere");
    $stmt->bindParam(':nom_filiere', $nom_filiere);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Afficher un message d'erreur si la filière existe déjà
        $error_message = "Cette filière existe déjà.";
    } else {
        // Ajouter la nouvelle filière dans la base de données
        $stmt = $pdo->prepare("INSERT INTO filiere (nom_filiere) VALUES (:nom_filiere)");
        $stmt->bindParam(':nom_filiere', $nom_filiere);
        $stmt->execute();

        // Rediriger après l'ajout
        header('Location: liste_filieres.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une filière</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 5px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: white;
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        footer a:hover {
            background-color: #34495e;
        }

        footer div {
            display: inline;
            justify-content: center;
            position: relative;
            margin-top: 10px;
            padding-right: 10px !important; 
        }

        @media screen and (max-width: 400px) {
            footer div {
                margin-left: 0px;
            }

            footer a {
                padding: 2px;
                margin: 0 3px;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'includesae/navbar.php'; ?>
        <?php include 'includesae/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="container">
                <h2>Ajout d'une filière</h2>

                <?php if ($error_message): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <form method="post" action="">
                    <label for="nom_filiere">Nom de la filière:</label>
                    <input type="text" id="nom_filiere" name="nom_filiere" class="form-control" required>

                    <!-- Ajoutez d'autres champs selon vos besoins -->

                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </form>
            </div>
        </div>

        <?php include 'includesae/footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-8W2M2Xz6PFLxyG5OT/gk/J7EoQhTr/ppYihmHt+M6RGMKROX56WXO3XhHPX9OQQ5" crossorigin="anonymous"></script>
</body>
</html>
