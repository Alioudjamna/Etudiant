<?php
   
   include 'configaf.php';

    // Filieres à ajouter
    $nouvellesFilieres = [
        'Optique lunetterie',
        'Réseau informatique et Télécommunication',
        'Génie civil : option bâtiment',
        'Mines-géologie-Pétrole',
        'Cosmétologie',
        'Génie énergétique et Environnement',
        'Maintenance, des systèmes électroniques et informatiques',
        'Electrotechnique',
        'Industries Agro-alimentaires et Chimiques : option production',
        'Industries Agro-alimentaires et chimiques : option contrôle',
        'Maintenance des systèmes de production',
        'Informatique : Développeur d’Application',
        'Art, Aménagement et cadre de vie',
        'Finance-Assurance',
        'Tourisme-Hôtellerie',
        'Logistique',
        'Gestion commerciale',
        'Ressources Humaines et Communication',
        'Assistanat de Direction',
        'Communication visuelle',
        'Finance comptabilité et gestion d’Entreprises',
        'Agriculture tropicale : option production animale',
        'Gestion des collectivités territoriales',
        'Gestion de l’Environnement et des Ressources Naturelles',
        'Agriculture tropicale : option production végétale',
    ];

    // Ajouter les nouvelles filières s'il y a des différences
    foreach ($nouvellesFilieres as $filiere) {
        // Vérifier si la filière existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM filiere WHERE nom_filiere = :nom_filiere");
        $stmt->bindParam(':nom_filiere', $filiere);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            // Ajouter la nouvelle filière si elle n'existe pas
            $stmt = $pdo->prepare("INSERT INTO filiere (nom_filiere) VALUES (:nom_filiere)");
            $stmt->bindParam(':nom_filiere', $filiere);
            $stmt->execute();
        }
    }

    // Récupérer la liste des filières depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM filiere ORDER BY nom_filiere");
    $stmt->execute();
    $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <title>Liste des filières</title>
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
            margin: 50px;
            
        }

        table {
            width: 100%;
            margin: auto;
            border: none;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .btn {
            margin-top: 20px;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .printable, .printable * {
                visibility: visible;
            }
            .printable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
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
                <h2>Liste des filières</h2>

                <!-- Afficher la liste des filières -->
                <table id="filiere" class="display nowrap printable" border="1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom de la filière</th>
                            <!-- Ajoutez d'autres colonnes selon vos besoins -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filieres as $filiere): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($filiere['nom_filiere']); ?></td>
                                <!-- Ajoutez d'autres colonnes selon vos besoins -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>    
            </div>
            </div>
        <?php include 'includesae/footer.php'; ?>
    </div>


    <script>
        $(document).ready(function() {
            $('#filiere').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Imprimer',
                        title: 'Liste des filières',
                        customize: function(win) {
                            $(win.document.body).css('font-size', '10pt').prepend(
                                '<h1>Liste des filières</h1>'
                            );
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Exporter Excel',
                        title: 'Liste des filières'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> Exporter CSV',
                        title: 'Liste des filières'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> Exporter PDF',
                        title: 'Liste des filières',
                        customize: function(doc) {
                            doc.content[1].table.widths = ['*'];
                        }
                    }
                ]
            });
        });
    </script>
</body>
</html>
