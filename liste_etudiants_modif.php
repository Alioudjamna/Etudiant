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

    // Récupérer la liste des étudiants depuis la base de données
    // Récupérer la liste des étudiants depuis la base de données en ordre alphabétique
    // Requête pour récupérer les étudiants et leur filière
    $sql = "SELECT etudiant.*, filiere.nom_filiere 
    FROM etudiant 
    LEFT JOIN filiere ON etudiant.id_filiere = filiere.id_filiere 
    ORDER BY etudiant.nom, etudiant.prenom";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des étudiants</title>
    <style>
        
        body {
            background-color: #f0f5f9;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
        }

        table {
            width: 100%;
            margin: auto;
            border: none;

        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dcdde1;
        }

        th {
            background-color: #3498db;
            color: #ffffff;
        }

        tr:hover {
            background-color: #ecf0f1;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 5px;
            position: fixed;
            bottom: 0%;
            width: 100%;
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

        footer div {
            display: inline;
            justify-content: center;
            position: relative;
            margin-top: 10px;
            padding-right: 10px !important; 
        }
        @media screen and (max-width: 400px) {
            footer div{
                margin-left: 0px;
            }
            footer a{
                padding: 2px;
                margin: 0 3px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des étudiants</h2>

        <!-- Afficher la liste des étudiants -->
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Filiere</th>
                    <th>Lieu de Naissance</th>
                    <th>Date de Naissance</th>
                    <th>modif</th>
                    <!-- Ajoutez d'autres colonnes selon vos besoins -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['prenom'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['sexe'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['nom_filiere'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['lieu_naissance'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['date_naissance'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><button><a href='modification_etudiantsss.php?id_etudiant=<?php echo $etudiant['id_etudiant']; ?>' ><i class="fa-solid fa-pen"></i>modifier</a></button></td>
                        <!-- Ajoutez d'autres colonnes selon vos besoins -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
