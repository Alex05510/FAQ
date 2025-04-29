<?php 

// Template

/**
 * Rôle : Permet à un utilisateur de répondre à une question spécifique
 *  - Il affiche les détails de la question, y compris l'auteur, le contenu et la date.
 * 
 * Paramètre :
 * - pseudo : Identifiant de l'utilisateur qui a posé la question.
 * - question : Texte de la question à laquelle on répond.
 * - date et heure : Date et heure de la question.
 * - reponse : Texte saisi par l'utilisateur pour répondre à la question.  
 */

 include_once('../../library/init.php'); // Initialisation de la BDD et des messages d'erreur
 include_once('../../library/bdd.php'); 
 ?>
 
 
 
 <?php
 
 // Connexion à la BDD
 $bdd = new PDO("mysql:host=172.18.0.1;dbname=faq-alau;charset=UTF8", "faq-alau", "V!21ukbuk");
 $sql = "SELECT * FROM `questions` WHERE `id` = :id";
 $req = $bdd->prepare($sql);
 $id = $_GET['id'] ?? null; // récupère l'id dans l'URL (ex: page.php?id=5)

if ($id) {
    $req->execute(['id' => $id]);
    $question = $req->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Erreur : Aucun ID de question fourni.";
    exit;
}


 
 ?>
 
 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Répondre à une question</title>
    <link rel="stylesheet" href="../../css/reponses.css">
</head>
<body>

<h2>Répondre à la question de <?=($question['pseudo'])?></h2>

<div class="container">
<div class="question-details">
    <p><strong>Question :</strong> <?=($question['question'])?></p>
    <p><strong>Date :</strong> <?= date("d/m/Y H:i:s",strtotime($question['date']))?></p>
</div>


<form action="../../cree_reponse.php" method="post">
    <input type="hidden" name="id_question" value="<?= ($id) ?>">

    <label for="pseudo">Votre pseudo :</label><br>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <label for="reponse">Votre réponse :</label><br>
    <textarea name="reponse" id="reponse" rows="6" cols="60" required></textarea><br>

    <button type="submit" class="submit">Envoyer la réponse</button>
    <a href="../../acceuil.php" class="back">Retour</a>
</form>
</div>
</body>
</html>
