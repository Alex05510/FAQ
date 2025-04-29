<?php
// Bon, première chose, on se connecte à la base de données
$bdd = new PDO("mysql:host=172.18.0.1;dbname=faq-alau;charset=UTF8", "faq-alau", "V!21ukbuk", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // On active le mode "exception" histoire que ça gueule bien en cas de pépin
]);

// On vérifie que la connexion est bien passée
if ($bdd) {
} else {
    echo("Erreur de connexion à la base de données."); //  message d'erreur si jamais ça bug
}

// check si le formulaire a bien été envoyé
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On récupère les données envoyées 
    $id_question = $_POST['id_question'] ?? null;
    $pseudo = $_POST['pseudo'] ?? null;
    $reponse = $_POST['reponse'] ?? null;

    // On s’assure que tous les champs sont remplis avant de continuer 
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
            echo "Erreur lors de l'enregistrement de la réponse."; // Message d’erreur en cas de bug
        }
    }
}

?>