<?php
include_once("library/init.php"); 
require_once("library/bdd.php");

//  vérification que la connexion à la BDD est bien en place
if (!$bdd) {
    echo "Erreur : Impossible de se connecter à la base de données."; // Si bug, on affiche un message d'erreur
    exit(); //on stoppe le script
}

// on check si le formulaire a été envoyé 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On récupère les données qui ont été envoyées par le formulaire
    $pseudo = $_POST['pseudo'] ?? ''; // Si y'a rien, on met une chaîne vide pour éviter les erreurs
    $question = $_POST['question'] ?? '';

    // On s'assure que les champs ne sont pas vides 
    if (!empty($pseudo) && !empty($question)) {
        
        // utilisation de la requête de bdd.php
        $id_question = bddInsertQuestion($pseudo, $question);

        // Si la question a été bien insérée 
        if ($id_question > 0) {
            header("Location: acceuil.php"); // on redirige l'utilisateur vers l'accueil
            exit(); // si c'est bon on stoppe le script ici
        } else {
            echo "Erreur lors de l'ajout de la question."; // sinon on affiche un message d'erreur
        }
    } else {
        echo "Erreur : Tous les champs doivent être remplis."; //  si quelqu'un essaie d'envoyer un truc vide
    }
}
?>
