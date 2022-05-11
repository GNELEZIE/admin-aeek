<?php

class Reponse{
    public function  __construct(){
        $this->bdd = bdd();
    }


    //Create
    public function addReponse($date_reponse,$nom,$email,$message, $comment_id,$articles_id){
        $query = "INSERT INTO reponse(date_reponse,nom,email,message,comment_id,article_id)
            VALUES (:date_reponse,:nom,:email,:message, :comment_id,:articles_id)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "date_reponse" => $date_reponse,
            "nom" => $nom,
            "email" => $email,
            "message" => $message,
            "comment_id" => $comment_id,
            "articles_id" => $articles_id
        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }

    //Read
    public function getAllReponse(){
        $query = "SELECT * FROM reponse
          WHERE statut =!1  ORDER BY id_reponse DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    public function getReponseByArticleId($id){
        $query = "SELECT * FROM reponse
        WHERE article_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }
    public function getReponseById($com_id,$art_id){
        $query = "SELECT * FROM reponse
        WHERE comment_id = :com_id AND article_id = :art_id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "com_id" => $com_id,
            "art_id" => $art_id
        ));
        return $rs;
    }

//Count
    public function nbReponses($com_id){
        $query = "SELECT COUNT(*) as nb FROM reponse
        WHERE comment_id = :com_id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "com_id" => $com_id

        ));
        return $rs;
    }
//    public function nbReponses(){
//
//        $query = "SELECT COUNT(*) as nb FROM reponse";
//        $rs = $this->bdd->query($query);
//
//        return $rs;
//    }
//Update






}

$reponse = new Reponse();