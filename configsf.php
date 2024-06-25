<?php
        $servername = "localhost";
        $dbname = "gestion_etudiants";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifie si le formulaire est soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_filiere = $_POST['id_filiere'];

                // Supprime la filière de la base de données
                $sql = "DELETE FROM filiere WHERE id_filiere = :id_filiere";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id_filiere' => $id_filiere]);

                echo 'Suppression réussie';
            }
        } catch(PDOException $e) {
            echo "Échec de la suppression: " . $e->getMessage();
        }
        ?>