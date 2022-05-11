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

    public function getAllCommentCinq(){
        $query = "SELECT * FROM comment
          WHERE statut =!1  ORDER BY id_comment DESC LIMIT 10";
        $rs = $this->bdd->query($query);
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



    public function updateCouverturePhoto($couverture,$id){
        $query = "UPDATE article
            SET couverture = :couverture
            WHERE id_article = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "couverture" => $couverture,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }


}

$comment = new Comment();