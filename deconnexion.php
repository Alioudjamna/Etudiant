<?php
include 'configd.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        p {
            color: #333;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        button:hover, a:hover {
            background-color: #0056b3;
        }
    </style>
    
    <script>
        // Fonction pour afficher la boîte de dialogue de confirmation
        function confirmerDeconnexion() {
            var confirmation = confirm("Voulez-vous vraiment vous déconnecter ?");
            if (confirmation) {
                window.location.href = 'deconnexion.php?confirm=true';
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Déconnexion</h2>

    <!-- Afficher le message de confirmation -->
    <p>Voulez-vous vraiment vous déconnecter ?</p>

    <!-- Bouton pour confirmer la déconnexion -->
    <button onclick="confirmerDeconnexion()">Oui, déconnectez-moi</button>

    <!-- Bouton pour annuler la déconnexion -->
    <a href="accueil.php">Annuler</a>
</div>



</body>
</html>
