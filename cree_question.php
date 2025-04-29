<?php
/**
 * Contrôleur
 * 
 * Rôle :
 * - Vérifie la connexion à la base de données avant traitement.
 * - Vérifie que le formulaire a bien été soumis via la méthode POST.
 * - Valide les données envoyées 
 * - Insère la question dans la table questions avec la date d'enregistrement.
 * - Redirige l'utilisateur vers la page d'accueil après l'enregistrement réussi.
 * 
 * Paramètres du formulaire attendus :
 * - pseudo : Nom ou pseudonyme de l'utilisateur.
 * - question : Texte de la question posée.
 */
include_once("library/init.php"); 
include_once("library/bdd.php");
include_once("model/articles.php");


//  vérification que la connexion à la BDD est bien en place
if (!$bdd) {
    echo "Erreur : Impossible de se connecter à la base de données."; // Si bug, on affiche un message d'erreur
    exit(); //on stoppe le script
}

// on check si le formulaire a été envoyé 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données envoyées
    $pseudo = $_POST['pseudo'] ?? '';
    $question = $_POST['question'] ?? '';

    // Vérifier que les champs ne sont pas vides
    if (!empty($pseudo) && !empty($question)) {
        // Insérer la question dans la base de données avec ta fonction
        $sql = "INSERT INTO questions (pseudo, question, date) VALUES (:pseudo, :question, NOW())";
        $param = ['pseudo' => $pseudo, 'question' => $question];

        if (bddRequest($sql, $param)) {
            header("Location: acceuil.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de la question.";
        }
    } else {
        echo "Erreur : Tous les champs doivent être remplis.";
    }
}
?>
