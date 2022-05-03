<?php

class Article{
    public function  __construct(){
        $this->bdd = bdd();
    }

    //Read

    public function getAllArticle(){
        $query = "SELECT * FROM article
          ORDER BY id_article DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }

//Update
    public function updateArticle($etat,$id){
        $query = "UPDATE article
            SET statut = :etat
            WHERE id_article = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

}

$article = new Article();