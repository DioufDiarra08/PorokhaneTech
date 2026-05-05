<?php
    require_once("dbModel.php");

   // Récupérer la liste des compétences
    function getAll() {
        $sql = "SELECT * FROM competences WHERE deleted_at IS NULL";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Erreur lors de la récupération des compétences : " . $error->getMessage());
        }
    }

    //Récupérer une compétence
    function getCompetencesById(int $id)
    {
        $sql = "SELECT * FROM competences WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            die("Erreur lors de la recupération de la compétence d'id $id " . $error->getMessage());
        }
    }

    // Ajouter une nouvelle compétence
    function add($nom, $description, $photo) {
        $sql = "INSERT INTO competences 
                (nom, description, photo, created_at, created_by)
                VALUES (:nom, :description, :photo, NOW(), :created_by)";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'description' => $description,
                'photo' => $photo,
                'created_by' => "admin@gmail.com",
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de la compétence $nom : " . $error->getMessage());
            throw $error;
        }
    }

    // Modifier une compétence
    function edit($id, $nom, $description, $photoName, $update_by) {
        $sql = "UPDATE competences 
            SET nom = :nom, description = :description, photo = :photo, update_by = :update_by 
            WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'description' => $description,
                'photo' => $photoName,
                'update_by' => $update_by,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de la compétence : " . $error->getMessage());
            throw $error;
        }
    }

    // Désactiver une compétence
    function desactivate($id, $update_by) {
        $sql = "UPDATE competences SET update_by = :update_by, deleted_at = NOW() WHERE id = :id";
    
        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute([
                'update_by' => $update_by,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la désactivation de la compétence d'id $id : " . $error->getMessage());
            throw $error;
        }
    }
    
    // Restauration d'une compétence (réactivation)
    function activate($id, $update_by) {
        $sql = "UPDATE competences SET deleted_at = NULL, update_by = :update_by WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute(['update_by' => $update_by, 'id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la restauration de la compétence d'id $id : " . $error->getMessage());
            throw $error;
        }
    }


    // Suppression définitive d'une compétence
    function delete($id) {
        $sql = "DELETE FROM competences WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression définitive de la compétence d'id $id : " . $error->getMessage());
            throw $error;
        }
    }

    // Permet de récupérer la liste des compétences supprimées
     function getAllDeleted() {
        $db = getConnexion(); // Appelle la fonction pour obtenir la connexion
        $sql = "SELECT * FROM competences WHERE deleted_at IS NOT NULL";
        $statement = $db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
?>