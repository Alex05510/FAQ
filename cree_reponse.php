<?php
/**
 * Contrôlleur
 * 
 * Role :
 * - Établit une connexion à la base de données.
 * - Vérifie la soumission d'un formulaire avant traitement.
 * - Valide les données envoyées par l'utilisateur.
 * - Insère la réponse dans la table reponses avec la date d'enregistrement.
 * - Redirige l'utilisateur vers la page d'accueil en cas de succès.
 * 
 * Paramètres :
 * - id_question  : Identifiant de la question concernée.
 * - pseudo  : Nom ou pseudonyme de l'utilisateur.
 * - reponse  : Texte de la réponse.
 */


include_once("library/init.php");
include_once("library/bdd.php"); 

// check si le formulaire a bien été envoyé
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On récupère les données envoyées 
    $id_question = $_POST['id_question'] ?? null;
    $pseudo = $_POST['pseudo'] ?? null;
    $reponse = $_POST['reponse'] ?? null;

    // On s’assure que tous les champs sont remplis 
    if (!empty($id_question) && !empty($pseudo) && !empty($reponse)) {
        // On prépare la requête SQL pour insérer la réponse dans la table reponses
        $sql = "INSERT INTO reponses (id_question, pseudo, reponse, date) VALUES (:id_question, :pseudo, :reponse, NOW())";
        $req = $bdd->prepare($sql); // On prépare la requête SQL

        // On exécute la requête avec les bonnes valeurs
        if ($req->execute([
            ':id_question' => $id_question,
            ':pseudo' => $pseudo,
            ':reponse' => $reponse
        ])) {
            // Si tout s'est bien passé, on redirige vers l'accueil 
            header("Location: acceuil.php");
            exit(); // On arrête le script 
        } else {
            echo "Erreur lors de l'enregistrement de la réponse."; // message d'erreur si jamais ça bug
        }
    }
}

?>