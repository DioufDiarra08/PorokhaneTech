<?php 
    // Fonction de connection à la BD
    function getConnexion()
    {
        // Déclaration des variables pour la connection à la BD
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "porokhanetechapp";
        $db = null; //contient l'instance de la BD

        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $error) {
            die("La connexion à la BD à échouée: " . $error->getMessage());
        }
    }
?>  
