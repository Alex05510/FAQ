<?php

// Initialisations communes à tous les controleurs 
// (à inclure en début de chaque controleur)


// mettre en place les messages d'erreur (pour la mise au point)
ini_set('display_errors',1);
error_reporting(E_ALL);

// Charger les différentes classes de modèle de données


// Ouvrir la BDD dans la variable globale $bdd
global $bdd;
$bdd = new PDO("mysql:host=172.18.0.1;dbname=faq-alau;charset=UTF8", "faq-alau", "V!21ukbuk");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING) ;  // En mise au point seulement