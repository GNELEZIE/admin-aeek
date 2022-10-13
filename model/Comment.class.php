<?php

class Comment{
    public function  __construct(){
        $this->bdd = bdd();
    }



    //Read
    public function getAllComment(){
        $query = "SELECT * FROM comment
          ORDER BY id_comment DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }
 public function getAllCommentEnAttente(){
        $query = "SELECT * FROM comment
         WHERE statut =!1  ORDER BY id_comment DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function getAllCommentValider(){
        $query = "SELECT * FROM comment
         WHERE statut =!0  ORDER BY id_comment DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    public function getAllCommentCinq(){
        $query = "SELECT * FROM comment ORDER BY id_comment DESC LIMIT 10";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    public function getCommentByArticleid($id){
        $query = "SELECT * FROM comment
        WHERE article_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }
    public function getCommentById($id){
        $query = "SELECT * FROM comment
        WHERE article_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }
    public function getCommentByIdNb($id){
        $query = "SELECT * FROM comment
        WHERE article_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

//Count
    public function nbComments(){

        $query = "SELECT COUNT(*) as nb FROM comment";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function nbCommentsEnAtt(){

        $query = "SELECT COUNT(*) as nb FROM comment
                  WHERE statut =!1 ";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function nbCommentsValid(){

        $query = "SELECT COUNT(*) as nb FROM comment
                  WHERE statut =!0 ";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function nbComment($id){
        $query = "SELECT  COUNT(*) as nb FROM comment
        WHERE article_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }
//Update

    //Update
    public function updateStatutComment($etat,$id){
        $query = "UPDATE comment
            SET statut = :etat
            WHERE id_comment = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    public function updateComment($message,$id){
        $query = "UPDATE comment
                 SET message = :message
           WHERE id_comment = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "message" => $message,
            "id" => $id

        ));
        $nb = $rs->rowCount();
        return $nb;
    }

    // Delete
    public function deleteComment($id){

        $query = "DELETE  FROM comment WHERE id_comment  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    public function deleteCommentByArticle($id){

        $query = "DELETE  FROM comment WHERE article_id  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }



}

$comment = new Comment();