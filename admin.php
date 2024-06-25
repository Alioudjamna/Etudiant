<?php
include 'configaf.php';

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

try {
    $pdo->beginTransaction();

    foreach ($nouvellesFilieres as $filiere) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM filiere WHERE nom_filiere = :nom_filiere");
        $stmt->bindParam(':nom_filiere', $filiere);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $stmt = $pdo->prepare("INSERT INTO filiere (nom_filiere) VALUES (:nom_filiere)");
            $stmt->bindParam(':nom_filiere', $filiere);
            $stmt->execute();
        }
    }

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
    die("Erreur lors de l'insertion des filières : " . $e->getMessage());
}

try {
    $stmt = $pdo->prepare("
        SELECT f.nom_filiere, COUNT(e.id_etudiant) AS nombre_etudiants
        FROM filiere f
        LEFT JOIN etudiant e ON f.id_filiere = e.id_filiere
        GROUP BY f.nom_filiere
        ORDER BY f.nom_filiere
    ");
    $stmt->execute();
    $filieres = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des filières : " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrateur</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
</head>

    

    <style>
        /* Masquer le tableau mais garder les boutons visibles */
        .container-table {
            display: none;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <?php include 'includes/navbar.php'; ?>
        <div class="content-wrapper">

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>Nouveau Etudiant</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>10</h3>
                                    <p>Nombre d'invité</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-envelope-open"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>5</h3>
                                    <p>Administrateur</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                <h3>550</h3>
                                    <p>Ancien etudiant</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Ajout du graphique circulaire -->
                    <div class="rec" style="display:flex">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Graphique circulaire des Étudiants en Filière</h3>
                                <div class="table-container">
                                    <div class="buttons-container">
                                        <button class="btn btn-success" onclick="exportExcel()">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                    </div>

                                    <!-- Afficher la liste des filières -->

                                    <div class="container-table">
                                        <h2>Répartition des Étudiants par filière</h2>
                                        <table id="filiere" class="display nowrap printable" border="1">
                                            <thead>
                                                <tr>
                                                    <th>Nom de la filière</th>
                                                    <th>Nombre d'étudiants</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($filieres as $filiere): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($filiere['nom_filiere']); ?></td>
                                                        <td><?php echo htmlspecialchars($filiere['nombre_etudiants']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="position: relative; height:500px; width:500px">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                            
                                    
                        
                
                        <!-- Ajout du graphique en baton -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Graphique à barres des Etudiants inscrits</h3>
                                <div class="buttons-container">
                                        <button class="btn btn-success" onclick="exportExcel()">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" style="height: 400px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Scripts AdminLTE et Chart.js -->
    <!--Data Table-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-NEXF6QiIhb9eHP9BwrHObH5AQeMT7yYXmGd4d5mg+w5ur3AoxXdh5BqBvS1xdD6U" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
     <!-- Ajout de Chart.js -->
<!--le script qui gere les mouvement du sidebar-->
    <script>
        $(document).ready(function () {
            $('[data-widget="pushmenu"]').PushMenu();
        });
    </script>
    <script>
        $(document).ready(function () {
            function toggleSidebar() {
                if ($(window).width() < 768) {
                    // Masquer le sidebar sur les petits écrans
                    $('body').addClass('sidebar-collapse');
                } else {
                    // Afficher le sidebar sur les grands écrans
                    $('body').removeClass('sidebar-collapse');
                }
            }

            // Initial call
            toggleSidebar();

            // Réagir au redimensionnement de la fenêtre
            $(window).resize(function () {
                toggleSidebar();
            });

            //Script du PieChart

            var ctx = document.getElementById('pieChart').getContext('2d');
            var pieChart;

            // Fonction pour générer des couleurs aléatoires
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Fonction pour générer une liste de couleurs
            function generateColors(numColors) {
                var colors = [];
                for (var i = 0; i < numColors; i++) {
                    colors.push(getRandomColor());
                }
                return colors;
            }

            // Fonction pour récupérer les données et mettre à jour le graphique
            function updateChart() {
                $.ajax({
                    url: 'data.php', // Le script PHP qui renvoie les données
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (pieChart) {
                            pieChart.destroy(); // Détruire le graphique précédent avant de le recréer
                        }

                        var backgroundColors = generateColors(data.values.length);
                        var borderColors = backgroundColors.map(color => color + '99'); // Ajouter un peu de transparence

                        pieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: 'Nombre d\'Étudiants',
                                    data: data.values,
                                    backgroundColor: backgroundColors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'right', // Positionne la légende à droite
                                        labels: {
                                            boxWidth: 20, // Largeur des carrés de couleur dans la légende
                                            padding: 15,  // Espacement entre les labels et le graphique
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Répartition des Étudiants par Filière'
                                    }
                                }
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Erreur lors de la récupération des données: ' + error);
                    }
                });
            }

            // Mettre à jour le graphique lors du chargement initial
            updateChart();
        });
    </script>


    <!--Script Bar chart-->
   <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2018', '2019', '2020', '2021', '2022'],
                datasets: [
                    {
                        label: 'Nouveaux Étudiants',
                        data: [150, 160, 170, 180, 190], // Remplacez par les valeurs réelles
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur bleue claire
                        borderColor: 'rgba(54, 162, 235, 1)', // Bordure bleue foncée
                        borderWidth: 1
                    },
                    {
                        label: 'Anciens Étudiants',
                        data: [140, 155, 165, 175, 285], // Remplacez par les valeurs réelles
                        backgroundColor: 'rgba(255, 159, 64, 0.2)', // Couleur orange claire
                        borderColor: 'rgba(255, 159, 64, 1)', // Bordure orange foncée
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Nombre de Nouveaux et Anciens Étudiants par Année'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
   </script>

    <!--script pour les export-->
    <script>
        $(document).ready(function() {
            $('#filiere').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        titleAttr: 'Export to Excel',
                    }
                ],
                responsive: true,
            });
        });

        function exportExcel() {
            var table = $('#filiere').DataTable();
            table.button('.buttons-excel').trigger();
        }

    </script>

</body>
</html>
