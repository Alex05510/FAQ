<?php 

// Template 

/**
 * Rôle : affiche la liste des questions posée par l'utilisateur
 * permet aux utilisateur de poser une nouvelle question
 * permet aux utilisateurs de répondre aux questions
 * 
 * - Affichage de la liste des questions sous forme HTML.
 * - Affichage des pseudos des utilisateur qui pose la questions.
 * - Affichage de la date et l’heure de chaque question.
 * - Bouton pour répondre à chaque question.
 * - Bouton pour poser une nouvelle question.
 */
include_once('library/init.php'); // Initialisation de la BDD et des messages d'erreur
include_once('library/bdd.php'); 




// Récupérer toutes les questions
$sql = "SELECT * FROM questions ORDER BY date DESC";
$questions = bddRequest($sql)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les réponses
$sql = "SELECT * FROM reponses ORDER BY date DESC";
$reponses = bddRequest($sql)->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des questions</title>
    <link rel="stylesheet" href="css/liste_question.css">
    <style>
        ul{
            flex-wrap: wrap;
        }
    </style>
</head>
<body>

<h1>FAQ</h1>
<a href="templates/pages/question.php"><button class="newQuestion">Poser une nouvelle question</button></a>

<?php if (!empty($questions)): ?>
    <ul class="questions">
    <?php foreach ($questions as $question): ?>
        <li>
            <strong><?= ($question['pseudo']) ?></strong> a demandé : 
            <?= ($question['question']) ?><br>
            <em>(<?= date("d/m/Y H:i:s",strtotime($question['date'])) ?>)</em>
            <button class="repondre"><a href="templates/pages/reponse.php?id=<?= $question['id'] ?>">Répondre à <?= ($question['pseudo']) ?></a></button>
            <h3>Réponses :</h3>
            <ul class="reponses">
                <?php foreach ($reponses as $reponse): ?>
                    <?php if ($reponse['id_question'] == $question['id']): ?>
                        <li>
                            <strong><?= ($reponse['pseudo']) ?></strong> a répondu : 
                            <?= ($reponse['reponse']) ?><br>
                            <em>(<?= date("d/m/Y H:i:s", strtotime($reponse['date'])) ?>)</em>

                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
    <p>Aucune question posée pour l'instant.</p>
<?php endif; ?>

</body>
</html>
