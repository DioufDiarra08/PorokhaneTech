<?php
    require_once("dbModel.php");

   // Récupérer la liste des experiences
    function getAllExperiences() {
        $sql = "SELECT * FROM experiences WHERE deleted_at IS NULL";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Erreur lors de la récupération des experiences : " . $error->getMessage());
        }
    }

    //Récupérer une experience
    function getExperiencesById(int $id)
    {
        $sql = "SELECT * FROM experiences WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            die("Erreur lors de la recupération de l'experience d'id $id " . $error->getMessage());
        }
    }

    // Ajouter une nouvelle experience
    function addExperiences($nom, $date_experiences) {
        $sql = "INSERT INTO experiences 
            (nom, date_experiences,  created_at, created_by)
            VALUES (:nom, :date_experiences,  NOW(), :created_by)";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'date_experiences' => $date_experiences,
                'created_by' => "admin@gmail.com",
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de l'experience $nom : " . $error->getMessage());
            throw $error;
        }
    }

    // Modifier une experience
    function editExperiences($id, $nom, $date_experiences, $update_by) {
        $sql = "UPDATE experiences 
            SET nom = :nom, date_experiences = :date_experiences, update_by = :update_by 
            WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'date_experiences' => $date_experiences,
                'update_by' => $update_by,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de l'experience : " . $error->getMessage());
            throw $error;
        }
    }

    // Désactiver une experience
    function desactivateExperiences($id, $update_by) {
        $sql = "UPDATE experiences SET update_by = :update_by, deleted_at = NOW() WHERE id = :id";
    
        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute([
                'update_by' => $update_by,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la désactivation de l'experience d'id $id : " . $error->getMessage());
            throw $error;
        }
    }
    
    // Restauration d'une experience (réactivation)
    function activateExperiences($id, $update_by) {
        $sql = "UPDATE experiences SET deleted_at = NULL, update_by = :update_by WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute(['update_by' => $update_by, 'id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la restauration de la experience d'id $id : " . $error->getMessage());
            throw $error;
        }
    }


    // Suppression définitive d'une experience
    function deleteExperiences($id) {
        $sql = "DELETE FROM experiences WHERE id = :id";

        try {
            $statement = getConnexion()->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression définitive de l'experience d'id $id : " . $error->getMessage());
            throw $error;
        }
    }

    // Permet de récupérer la liste des experiences supprimées
     function getAllExperiencesDeleted() {
        $db = getConnexion(); // Appelle la fonction pour obtenir la connexion
        $sql = "SELECT * FROM experiences WHERE deleted_at IS NOT NULL";
        $statement = $db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
?>