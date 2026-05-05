<?php
session_start();
require_once("../model/experiencesModel.php");

// Gestion des redirections
function setErrorAndRedirect($message, $title, $pageRedirect = "listesExperiences") {
    $_SESSION["error"] = $message;
    header("Location: $pageRedirect?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
    exit;
}

function setSuccessAndRedirect($message, $title, $pageRedirect = "listesExperiences") {
    $_SESSION["success"] = $message;
    header("Location: $pageRedirect?success=1&message=" . urlencode($message) . "&title=" . urlencode($title));
    exit;
}

// Ajouter une expériences
if (isset($_POST["formAddExperiences"])) {
    $nom = trim($_POST['nom'] ?? '');
    $date_experiences = trim($_POST['date_experiences'] ?? '');

    if (empty($nom) || empty($date_experiences)) {
        setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur d'ajout");
    }

    try {
        $result = addExperiences($nom, $date_experiences);
        if ($result) {
            setSuccessAndRedirect("Expériences ajoutée avec succès.", "Ajout réussi");
        } else {
            setErrorAndRedirect("Erreur lors de l'ajout de l'expériences.", "Erreur d'ajout");
        }
    } catch (Exception $error) {
        setErrorAndRedirect("Erreur : " . $error->getMessage(), "Erreur d'ajout");
    }
}

// // Modifier une expériences
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-id'])) {
//     $id = intval($_POST['edit-id'] ?? 0);
//     $nom = trim($_POST['edit-nom'] ?? '');
//     $description = trim($_POST['edit-description'] ?? '');
//     $photo = $_FILES['edit-photo'] ?? null;
//     $photoName = null;
//     $update_by = "admin@gmail.com";

//     if (empty($id) || empty($nom) || empty($description)) {
//         setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification");
//     }

//     if ($photo && $photo['error'] === 0) {
//         $uploadDir = "../public/images/";
//         $photoName = uniqid() . "_" . basename($photo['name']);
//         $uploadPath = $uploadDir . $photoName;

//         if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
//             setErrorAndRedirect("Échec du téléchargement de l'image.", "Erreur de modification");
//         }
//     } else {
//         $photoName = $_POST['current-photo'] ?? '';
//     }

//     try {
//         $result = editExperiences($id, $nom, $description, $photoName, $update_by);
//         if ($result) {
//             setSuccessAndRedirect("Expériences modifiée avec succès.", "Modification réussie");
//         } else {
//             setErrorAndRedirect("Aucune modification effectuée.", "Modification");
//         }
//     } catch (Exception $e) {
//         setErrorAndRedirect("Erreur : " . $e->getMessage(), "Erreur de modification");
//     }
// }

// Désactiver une expériences
if (isset($_GET['idExperiencesToDelete'])) {
    $id = intval($_GET['idExperiencesToDelete']);
    if (empty($id)) {
        setErrorAndRedirect("Impossible de désactiver cette expériences", "Informations manquantes");
    }

    try {
        $result = desactivateExperiences($id, "admin@gmail.com");
        if ($result) {
            setSuccessAndRedirect("Expériences supprimée avec succès.", "Suppression réussie");
        }
    } catch (Exception $error) {
        setErrorAndRedirect("Erreur lors de la suppression : " . $error->getMessage(), "Erreur de suppression");
    }
}

// Restaurer une expérience
if (isset($_GET['idExperiencesToRestore'])) {
    $id = intval($_GET['idExperiencesToRestore']);
    if (empty($id)) {
        setErrorAndRedirect("Impossible de restaurer cette expérience", "Informations manquantes");
    }

    try {
        $result = activateExperiences($id, "admin@gmail.com");
        if ($result) {
            setSuccessAndRedirect("Expériences restaurée avec succès.", "Restauration réussie");
        } else {
            setErrorAndRedirect("Impossible de restaurer cette expérience.", "Erreur de restauration");
        }
    } catch (Exception $error) {
        setErrorAndRedirect("Erreur lors de la restauration : " . $error->getMessage(), "Erreur de restauration");
    }
}
?>


    
    
    // // Permet de supprimer définitivement une compétence de la BD
    // if (isset($_GET['idExperiencesToUpdatePermanent'])) {
    //     $id = intval($_GET['idExperiencesToUpdatePermanent']);

    //     // Vérification des données
    //     if (empty($id)) {
    //         setErrorAndRedirect("Impossible de supprimer cette compétence", "Information manquantes");
    //     }

    //     // Appelle du repository pour supprimer définitivement
    //     try {
    //         $result = Update($id);

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