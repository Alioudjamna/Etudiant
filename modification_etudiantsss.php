<?php
    include 'confime.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
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
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'includesae/navbar.php'; ?>
        <?php include 'includesae/sidebar.php'; ?>
        <div class="content-wrapper">
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
            </div>
        <?php include 'includesae/footer.php'; ?>
    </div>
</body>
</html>
