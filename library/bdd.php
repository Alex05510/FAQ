<?php 
/*
Librairie de fonctions d'accès à la Base de données
Les fonctions s'appuient sur $bdd, variable globale contenant un objet PDO initialisé sur la bonne BDD
*/
// Connexion à la BDD : initialisation de la variable globale $bdd  
function bddRequest($sql, $param = []) {
    global $bdd;

    $req = $bdd->prepare($sql);
    if (empty($req)) {
        return false;
    }

    $cr = $req->execute($param);
    return $cr ? $req : false;
}

// Fonction pour insérer une nouvelle question
function bddInsertQuestion($pseudo, $question) {
    global $bdd;

    // Construire la requête
    $sql = "INSERT INTO `questions` SET `pseudo` = :pseudo, `question` = :question, `date` = :date";

    
    // Tableau des paramètres
    $param = [
        ":pseudo" => $pseudo,
        ":question" => $question,
        ":date" => date('d-m-y H:i:s')
    ];

    // Exécuter la requête
    $req = bddRequest($sql, $param);

    // Retourner l'ID créé ou 0 en cas d'échec
    return $req ? $bdd->lastInsertId() : 0;
}
?>