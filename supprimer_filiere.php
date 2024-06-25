

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une filière</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
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

        .btn-primary {
            background-color: #dc3545; /* Rouge pour le bouton de suppression */
            border-color: #dc3545;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            margin-left: 0!important;
            width: 100%;
            margin-top: auto; /* Assure que le footer reste en bas */
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
            background-color: #34495e;
        }
    </style>
   
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'includesae/navbar.php'; ?>
        <?php include 'includesae/sidebar.php'; ?>
        <div class="content-wrapper">
            <div class="container">
                <h2>Supprimer une filière</h2>
                <?php include 'configsf.php';?>
                
                <form id="deleteForm" action="supprimer_filiere.php" method="post">
            <label for="id_filiere">Sélectionnez une filière à supprimer:</label><br>
            <!-- Afficher la liste des filières à partir de la base de données -->
            <select name="id_filiere" required>
                <?php
                // Connexion à la base de données (ajustez les paramètres selon votre configuration)
                $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupérer la liste des filières depuis la base de données
                $sql = "SELECT DISTINCT nom_filiere, id_filiere FROM filiere ORDER BY nom_filiere ASC";
                $stmt = $pdo->query($sql);
                $filiere_array = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if (!in_array($row['nom_filiere'], $filiere_array)) {
                        echo "<option value=\"" . $row['id_filiere'] . "\">" . $row['nom_filiere'] . "</option>";
                        $filiere_array[] = $row['nom_filiere'];
                    }
                }
                ?>
            </select><br>

            <input type="button" class="btn-danger" value="Supprimer" onclick="confirmDelete()">
        </form>

        <script>
            function confirmDelete() {
                if (confirm("Êtes-vous sûr de vouloir supprimer cette filière ?")) {
                    document.getElementById('deleteForm').submit();
                }
            }
        </script>


            
            </div>

            <script>
                function confirmDelete() {
                    if (confirm("Voulez-vous vraiment supprimer cette filière?")) {
                        document.getElementById("deleteForm").submit();
                    }
                }
            </script>
        <?php include 'includesae/footer.php'; ?>
    </div>
</div>
    
</body>
</html>