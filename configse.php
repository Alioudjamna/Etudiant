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
                if (isset($_POST['confirm_suppression']) && $_POST['confirm_suppression'] === 'oui') {
                    // Supprime l'étudiant de la base de données après confirmation
                    $id_etudiant = $_POST['id_etudiant'];
                    $sql = "DELETE FROM etudiant WHERE id_etudiant = :id_etudiant";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([':id_etudiant' => $id_etudiant]);

                    echo 'Suppression réussie';

                    // Ajoutez un délai avant la redirection (par exemple, 2 secondes)
                    echo '<meta http-equiv="refresh" content="2;url=liste_etudiants.php">';
                } else {
                    // Affiche la confirmation
                    $id_etudiant = $_POST['id_etudiant'];
                    echo "<p>Voulez-vous vraiment supprimer cet étudiant?</p>";
                    echo "<form action=\"supprimer_etudiant.php\" method=\"post\">";
                    echo "<input type=\"hidden\" name=\"id_etudiant\" value=\"$id_etudiant\">";
                    echo "<input type=\"hidden\" name=\"confirm_suppression\" value=\"oui\">";
                    echo "<button type=\"submit\" class=\"btn-primary\">Oui, Supprimer</button>";
                    echo "</form>";
                    echo "<a href=\"liste_etudiants.php\">Annuler</a>";
                }
            } else {
                // Affiche le formulaire pour choisir l'étudiant à supprimer
                echo "<form action=\"supprimer_etudiant.php\" method=\"post\">";
                echo "<label for=\"id_etudiant\">Sélectionnez un étudiant à supprimer:</label><br>";
                echo "<select name=\"id_etudiant\" required>";
                $sql = "SELECT id_etudiant, nom, prenom FROM etudiant";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"" . $row['id_etudiant'] . "\">" . $row['nom'] . " " . $row['prenom'] . "</option>";
                }
                echo "</select><br>";
                echo "<input type=\"submit\" class=\"btn-primary\" value=\"Supprimer\">";
                echo "</form>";
            }
        } catch(PDOException $e) {
            echo "Échec de la suppression: " . $e->getMessage();
        }
        ?>