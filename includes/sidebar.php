<!-- includes/sidebar.php -->
<?php
// Assurez-vous que la session est démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <?php
                    // Vérifiez si 'identifiant' est défini dans $_SESSION
                    if (isset($_SESSION['identifiant'])) {
                        echo htmlspecialchars($_SESSION['identifiant']);
                    } else {
                        echo "Utilisateur non connecté";
                    }
                    ?>
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="ajout_etudiant.php" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Ajout Étudiant</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="liste_etudiants.php" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Liste Étudiant</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="liste_etudiants_modif.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Modification Étudiants</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="supprimer_etudiant.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Supprimer Étudiants</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ajout_filiere.php" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Ajouter Filière</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="liste_filieres.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Liste Filières</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="modification_filiere.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Modification Filières</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="supprimer_filiere.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Supprimer Filières</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
