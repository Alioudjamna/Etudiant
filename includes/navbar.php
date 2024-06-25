<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-green navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
       <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
       </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="admin.php" class="nav-link">Accueil</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Account -->
        <li class="nav-item">
            <a class="nav-link" href="deconnexion.php">Déconnexion</a>
        </li>
    </ul>
</nav>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

<!-- AdminLTE JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>


<script>
    $(document).ready(function () {
        // Détectez le clic sur le bouton de menu
        $('#sidebarToggle').on('click', function () {
            // Affichez le sidebar s'il est masqué
            $('body').toggleClass('sidebar-open');
        });
    });
</script>
