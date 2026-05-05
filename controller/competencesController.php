<?php
    session_start();
    require_once("../model/competencesModel.php");


    //Permet faire la gestion des messages erreurs
    function setErrorAndRedirect($message, $title, $pageRedirect = "listesCompetences")
    {
        $_SESSION["error"] = $message;
        header("Location:$pageRedirect?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
        exit;
    }

    //Permet faire la gestion des messages success
    function setSuccessAndRedirect($message, $title, $pageRedirect = "listesCompetences")
    {
        $_SESSION["success"] = $message;
        header("Location: $pageRedirect?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
        exit;
    }

    // Ajouter une compétence dans la BD
    if (isset($_POST["formAddCompetences"])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $photo = $_FILES['photo'] ?? null;

            // Validation des données
            if (empty($nom) || empty($description) || !$photo) {
                setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur d'ajout");
            }

            if ($photo['error'] !== UPLOAD_ERR_OK) {
                setErrorAndRedirect("Erreur lors du téléchargement de la photo.", "Erreur d'ajout");
            }

           // Récupération de la photo
           $uploadDir = "../public/images/";
           $photoName = uniqid() . "_" . basename($photo['name']);
           $uploadPath = $uploadDir . $photoName;
           // Dépacement de la photo dans compétences
           if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
               setErrorAndRedirect("Echec du téléchargment de l'image.", "Erreur d'ajout");
           }
           // Appele de la méthode add pour insérer dans la base de données
           try {

               $reponse = add($nom, $description, $photoName);

               // var_dump($reponse); die;
               if ($reponse) {
                    setSuccessAndRedirect("Compétence ajoutée avec succès", "Ajout réussi");
               } else {
                   setErrorAndRedirect("Une erreur est survenue lors de l'ajout de la compétence.", "Erreur d'ajout");
               }
           } catch (Exception $error) {
               setErrorAndRedirect("Erreur " . $error->getMessage(), "Erreur d'ajout");
           }
       }
    }

    // Permet de modifier une compétence dans la BD
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit-id'])) {
        $id = intval(trim($_POST['edit-id'] ?? ''));
        $nom = trim($_POST['edit-nom'] ?? '');
        $description = trim($_POST['edit-description'] ?? '');
        $photo = $_FILES['edit-photo'] ?? null;
        $photoName = null;
        $update_by = "admin@gmail.com";
    
        // Validation des champs
        if (empty($nom) || empty($description)) {
            setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification");
        }
    
        // Gestion de l'image
        if ($photo && $photo['error'] === 0) {
            $uploadDir = "../public/images/";
            $photoName = uniqid() . "_" . basename($photo['name']);
            $uploadPath = $uploadDir . $photoName;
    
            if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                setErrorAndRedirect("Échec du téléchargement de l'image.", "Erreur de modification");
            }
        } else {
            $photoName = $_POST['current-photo'] ?? ''; // Si l’image n’est pas modifiée
        }
    
        // Appel à la fonction du model
        try {
            $result = edit($id, $nom, $description, $photoName, $update_by);
            if ($result) {
                setSuccessAndRedirect("Compétence modifiée avec succès.", "Modification réussie");
            } else {
                setErrorAndRedirect("Aucune modification effectuée.", "Modification");
            }
        } catch (Exception $e) {
            setErrorAndRedirect("Erreur : " . $e->getMessage(), "Erreur de modification");
        }
    }

    //Permet de désactiver une compétence dans la BD
    if(isset($_GET["idCompetencesToDelete"]))
    {
        $id = intval($_GET['idCompetencesToDelete']);
             
        // Vérification des données
        if (empty($id) ) {
            setErrorAndRedirect("Impossible de désactiver cette compétence", "Information manquantes");
        }


        //Appelle du repository pour désactiver
        try {
            $result = desactivate($id, "admin@gmail.com");

          
            if ($result) {
                setSuccessAndRedirect("Compétence supprimée avec succès", "Suppréssion réussie");
            }
        } catch (Exception $error) {
            setErrorAndRedirect("Erreur lors de la suppréssion " . $error->getMessage(), "Erreur de suppéssion");
        }
    }

    // Permet de restaurer une compétence dans la BD
    if (isset($_GET['idCompetencesToRestore'])) {
        $id = intval($_GET['idCompetencesToRestore']);

        // Vérification des données
        if (empty($id)) {
            setErrorAndRedirect("Impossible de restaurer cette compétence", "Information manquantes");
        }

        // Appelle du repository pour restaurer
        try {
            $result = activate($id, "admin@gmail.com");

            if ($result) {
                setSuccessAndRedirect("Compétence restaurée avec succès", "Restauration réussie");
            } else {
                setErrorAndRedirect("Impossible de restaurer cette compétence", "Erreur de restauration");
            }
        } catch (Exception $error) {
            setErrorAndRedirect("Erreur lors de la restauration : " . $error->getMessage(), "Erreur de restauration");
        }
    }

    
    
    // // Permet de supprimer définitivement une compétence de la BD
    // if (isset($_GET['idCompetencesToDeletePermanent'])) {
    //     $id = intval($_GET['idCompetencesToDeletePermanent']);

    //     // Vérification des données
    //     if (empty($id)) {
    //         setErrorAndRedirect("Impossible de supprimer cette compétence", "Information manquantes");
    //     }

    //     // Appelle du repository pour supprimer définitivement
    //     try {
    //         $result = delete($id);

    //         if ($result) {
    //             setSuccessAndRedirect("Compétence supprimée définitivement avec succès", "Suppression réussie");
    //         } else {
    //             setErrorAndRedirect("Impossible de supprimer cette compétence définitivement", "Erreur de suppression");
    //         }
    //     } catch (Exception $error) {
    //         setErrorAndRedirect("Erreur lors de la suppression définitive : " . $error->getMessage(), "Erreur de suppression");
    //     }
    // }



    //Permet d'activer une réalisation ou service dans la BD
    // function activateServiceRea()
    // {
    //     $id = intval($_GET['id']);
    //     $updatedBy = $_SESSION['id'] ?? null;
    //     $etatUser = $_SESSION['etat'] ?? null;

    //     // Vérification de l'état de l'utilisateur
    //     if ($etatUser !== 1) {
    //         setErrorAndRedirect("Votre compte n est pas actif", "Accès non autorisé", "login");
    //     }

    //     // Vérification des données
    //     if (empty($id) || empty($updatedBy)) {
    //         setErrorAndRedirect("Impossible d activer cette réalisation", "Information manquantes");
    //     }

    //     //Appelle du repository pour désactiver
    //     try {
    //         $result = activate($id, $updatedBy);

    //         if ($result) {
    //             setSuccessAndRedirect("Réalisation/service restaurée avec succès", "Réstauration réussie");
    //         }
    //     } catch (Exception $error) {
    //         setErrorAndRedirect("Erreur lors de la restauration " . $error->getMessage(), "Erreur de Réstauration");
    //     }
    // }


    //Permet de modifier une réalisation ou service dans la BD
    // function editServiceRea()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         //Recupération des données du formulaire
    //         $id = intval(trim($_POST['edit-id'] ?? ''));
    //         $nom = trim($_POST['edit-nom'] ?? '');
    //         $description = trim($_POST['edit-description'] ?? '');
    //         $type = trim($_POST['edit-type'] ?? '');
    //         $updatedBy = $_SESSION['id'] ?? null;
    //         $photo = $_FILES['edit-photo'] ?? null;

    //         //Validation des données
    //         if (empty($nom) || empty($description) || empty($type)) {
    //             setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification");
    //         }

    //         // Validation du type
    //         if (!in_array($type, ['R', 'S'])) {
    //             setErrorAndRedirect("Le type sélectionné est invalide.", "Erreur de modification");
    //         }

    //         //Validation de la photo
    //         $photoName = null;
    //         if ($photo) {

    //             $uploadDir = "../../images/servicesRea/";
    //             $photoName = uniqid() . "_" . basename($photo['name']);
    //             $uploadPath = $uploadDir . $photoName;

    //             // Dépacement de la photo dans servicesRea
    //             if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
    //                 setErrorAndRedirect("Echec du téléchargment de l'image.", "Erreur de modification");
    //             }
    //         }

    //         // Si aucune photo n'est choisie, conserver l'ancienne photo
    //         if (!$photoName) {
    //             $photoName = trim($photo['current-photo'] ?? '');
    //         }

    //         // Appele de la méthode edit pour modifier dans la base de données
    //         try {

    //             $reponse = edit($id, $nom, $description, $photoName, $type, $updatedBy);
    //             if ($reponse) {
    //                 $msg = $type == 'R' ? "Réalisation modifiée avec success" : "Service modifié avec success";
    //                 setSuccessAndRedirect($msg, "Modification réussi");
    //             } else {
    //                 setErrorAndRedirect("Une erreur est survenue lors de la modification.", "Erreur de modification");
    //             }
    //         } catch (Exception $error) {
    //             setErrorAndRedirect("Erreur " . $error->getMessage(), "Erreur de modification");
    //         }

    //     }
    // }

?>