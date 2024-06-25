<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE v4</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; }
        .container { max-width: 1200px; margin: 20px auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #343a40; text-align: center; }
        .dashboard { display: flex; flex-wrap: wrap; justify-content: space-around; margin-top: 20px; }
        .dashboard-item { width: 200px; height: 150px; background-color: #007bff; color: white; text-align: center; line-height: 150px; font-size: 18px; margin: 10px; border-radius: 8px; text-decoration: none; }
        .dashboard-item:hover { background-color: #0056b3; }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="content-wrapper">
            <div class="container">
                <h2>Bienvenue sur la page d'accueil</h2>
                <div class="dashboard">
                    <a href="admin.php" class="dashboard-item">Page administrateur</a>
                    <a href="liste_etudiants.php" class="dashboard-item">Liste des étudiants</a>
                    <a href="liste_filieres.php" class="dashboard-item">Liste des filières</a>
                    <a href="ajout_etudiant.php" class="dashboard-item">Ajout d'un étudiant</a>
                    <a href="ajout_filiere.php" class="dashboard-item">Ajout d'une filière</a>
                    <a href="liste_etudiants_modif.php" class="dashboard-item">Modif etudiant</a>
                    <a href="modification_filiere.php" class="dashboard-item">Modification d'une filière</a>
                </div>
                <p><a href="deconnexion.php">Se déconnecter</a></p>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
