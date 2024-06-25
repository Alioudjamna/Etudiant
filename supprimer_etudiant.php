<?php
include 'configset.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un étudiant</title>
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
            padding: 20px;
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
                <h2>Supprimer un étudiant</h2>
                <?php
                include 'configse.php';
                ?>
            </div>
        </div>
        
        <?php include 'includesae/footer.php'; ?>
    </div>

    
</body>
</html>
