<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrateur</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }

            header {
                background-color: #3498db;
                color: white;
                text-align: center;
                padding: 1em;
            }

            nav {
                background-color: #2c3e50;
                color: white;
                padding: 1em;
                text-align: center;
                
            }

            nav a {
                
                color: white;
                text-decoration: none;
                padding: 10px;
                margin: 0 10px;
                text-align: center;
                border-radius: 5px;
                background-color: #4a6572;
            }

            nav a:hover {
                background-color: #596f7a;
            }

            section {
                margin: 20px;
                padding: 20px;
                background-color: #ecf0f1;
                overflow-x: hidden;
                border-radius: 10px;
            }

            footer {
                background-color: #3498db;
                color: white;
                text-align: center;
                position: center;
                padding: 5px;
                position: fixed;
                position: relative;
                bottom: 0;
            }

            footer p {
                margin: 0;
            }

            footer a {
                color: white;
                text-decoration: none;
                margin: 0 1px;
                padding: 5px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            footer a:hover {
                background-color: #4a90e2;
            }

            footer div {
                display: flex;
                justify-content: center;
                position: relative;
                margin: 10px;
                padding-right: 10px !important; 
            }
            @media screen and (max-width: 550px) {
                nav a{
                    display: flex;
                    
                    line-height: 10px;
                    width: 180px;
                    margin:10px auto;
                    padding:1em;
                    text-align: center;
                }
                footer a{
                    display: flex;
                }
                footer div{
                    display: none;
                    justify-content: none;
                }
            }
            @media screen and (max-width: 590px){
                nav a{
                    margin:5px;
                    display: inline-block;                   
                    padding: 1em;
                }
            }
        </style>
</head>
<body>

    <header>
        <h1>Panel Administrateur</h1>
    </header>

    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="liste_etudiants.php">Liste des Étudiants</a>
        <a href="liste_filieres.php">Liste des Filières</a>
        <h2>Bienvenue, Administrateur!</h2>
        <p>Vous pouvez gérer les étudiants, les filières et d'autres fonctionnalités administratives à partir d'ici.</p>

        <h3>Gestion des Étudiants</h3>
        <a href="ajout_etudiant.php">Ajout un étudiant</a>
        <a href="liste_etudiants_modif.php">Modifier un étudiant</a>
        <a href="supprimer_etudiant.php">Supprimer un étudiant</a>

        <h3>Gestion des Filières</h3>
        <a href="ajout_filiere.php">Ajouter une filière</a>
        <a href="modification_filiere.php">Modifier une filière</a>
        <a href="supprimer_filiere.php">Supprimer une filière</a>
    </nav>

    <section>
        <h2>Bienvenue, Administrateur!</h2>
        <p>Vous pouvez gérer les étudiants, les filières et d'autres fonctionnalités administratives à partir d'ici.</p>
        <!-- Ajoutez du contenu spécifique pour les administrateurs -->
    </section>

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
