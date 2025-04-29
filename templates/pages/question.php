<?php 

// Template

/**
 * Rôle : Permet à un utilisateur de poser une question 
 * 
 * Paramètres :
 *  - pseudo : Identifiant de l’utilisateur qui pose la question.
 *  - question : Texte de la question saisie.
 *  - date et heure : Date et heure de soumission de la question.
 */ 
include_once('../../library/init.php'); // Initialisation de la BDD et des messages d'erreur

  ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Poser une question</title>
    <link rel="stylesheet" href="../../css/question.css">
</head>
<body>

<h1>Pose ta question</h1>

<form action="../../cree_question.php" method="POST">
    <label for="pseudo">Pseudo :</label><br>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <label for="question">Question :</label><br>
    <textarea type="textarea" id="question" name="question" rows="4" cols="50" required></textarea><br><br>

    <button type="submit" class="submit">Envoyer la question</button>
    <button class="back"><a href="../../acceuil.php">Retour</a></button>
    <?php 
      ?>
    
</form>

</body>
</html>

  
 