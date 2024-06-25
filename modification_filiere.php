<?php
// Inclusion unique du fichier de configuration
$configFile = 'configmf.php';
if (file_exists($configFile)) {
    include_once $configFile;
} else {
    die('Erreur : fichier ' . htmlspecialchars($configFile) . ' manquant.');
}

// Vérification de la connexion à la base de données
try {
    if (!isset($conn)) {
        throw new Exception('Connexion à la base de données non définie.');
    }
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une filière</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="stylese.css"> <!-- Ajout d'un fichier CSS externe -->
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        $navbarFile = 'includesae/navbar.php';
        if (file_exists($navbarFile)) {
            include $navbarFile;
        } else {
            echo '<p>Erreur : navbar manquant.</p>';
        }

        $sidebarFile = 'includesae/sidebar.php';
        if (file_exists($sidebarFile)) {
            include $sidebarFile;
        } else {
            echo '<p>Erreur : sidebar manquant.</p>';
        }
        ?>
        <div class="content-wrapper">
            <div class="container">
                <h2>Modifier une filière</h2>
                <form action="modification_filiere.php" method="post">
                    <label for="ancien_nom">Ancien nom de la filière:</label><br>
                    <select name="ancien_nom" id="ancien_nom" required>
                        <?php
                        try {
                            $sql = "SELECT nom_filiere FROM filiere";
                            $stmt = $conn->query($sql);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . htmlspecialchars($row['nom_filiere']) . '">' . htmlspecialchars($row['nom_filiere']) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . htmlspecialchars($e->getMessage());
                        }
                        ?>
                    </select><br>

                    <label for="nouveau_nom">Nouveau nom de la filière:</label><br>
                    <input type="text" id="nouveau_nom" name="nouveau_nom" required><br>
                    <input type="submit" value="Modifier">
                </form>
            </div>
        <?php
        $footerFile = 'includesae/footer.php';
        if (file_exists($footerFile)) {
            include $footerFile;
        } else {
            echo '<p>Erreur : footer manquant.</p>';
        }
        ?>
    </div>
</body>
</html>
