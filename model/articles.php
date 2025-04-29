<?php

// Classe : Question
// Gestion des objets "question"
include_once('library/init.php'); 

class Question {

    protected $id;
    protected $pseudo; 
    protected $id_question; 
    protected $reponse; 
    protected $date; 

   

    // Vérifier si l'objet est bien chargé
    function is() {
        if (!empty($this->id)) {
            return true;
        } else {
            return false;
        }
    }

    // Récupérer l'ID de la question
    function getId() {
        if (isset($this->id)) {
            return $this->id;
        } else {
            return 0;
        }
    }

    // Getters pour récupérer les valeurs
    function getPseudo() {
        if (isset($this->pseudo)) {
            return $this->pseudo;
        } else {
            return "";
        }
    }

    function getReponse() {
        if (isset($this->reponse)) {
            return $this->reponse;
        } else {
            return "";
        }
    }

    function getDate() {
        if (isset($this->date)) {
            return $this->date;
        } else {
            return "";
        }
    }

    // Setters pour modifier les valeurs
    function setPseudo($pseudo) {
        if (!empty($pseudo)) {
            $this->pseudo = $pseudo;
            return true;
        } else {
            return false;
        }
    }

    function setReponse($reponse) {
        if (!empty($reponse)) {
            $this->reponse = $reponse;
            return true;
        } else {
            return false;
        }
    }

    function setQuestionId($id_question) {
        if (!empty($id_question)) {
            $this->id_question = $id_question;
            return true;
        } else {
            return false;
        }
    }

    // Charger une question depuis la BDD
    function loadFromId($id) {
        global $bdd;
        $sql = "SELECT * FROM questions WHERE id = :id";
        $param = [":id" => $id];

        $req = bddRequest($sql, $param);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // Assigner les valeurs si les données existent
            $this->id = $data['id'];
            $this->pseudo = $data['pseudo'];
            $this->id_question = $data['id_question'];
            $this->reponse = $data['reponse'];
            $this->date = $data['date'];
            return true;
        } else {
            return false;
        }
    }

    // Insérer une nouvelle question dans la BDD
    function insert() {
        global $bdd;
        if (!empty($this->pseudo) && !empty($this->id_question) && !empty($this->reponse)) {
            $sql = "INSERT INTO questions (pseudo, id_question, reponse, date) 
                    VALUES (:pseudo, :id_question, :reponse, NOW())";
            $param = [
                ":pseudo" => $this->pseudo,
                ":id_question" => $this->id_question,
                ":reponse" => $this->reponse
            ];

            if (bddRequest($sql, $param)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
