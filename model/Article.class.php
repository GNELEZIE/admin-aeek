<?php

class Article{
    public function  __construct(){
        $this->bdd = bdd();
    }

    // Create

    public function addArticle($dateArticle,$titre,$categorie_id,$description,$couverture,$slug,$userId){
        $query = "INSERT INTO article(date_article,titre,categorie_id,description,couverture,slug,user_id)
            VALUES (:dateArticle,:titre,:categorie_id,:description,:couverture,:slug,:userId)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateArticle" => $dateArticle,
            "titre" => $titre,
            "categorie_id" => $categorie_id,
            "description" => $description,
            "couverture" => $couverture,
            "slug" => $slug,
            "userId" => $userId

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
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

    // Verification valeur existant
    public function verifArticle($propriete,$val){
        $query = "SELECT * FROM article WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }

}

$article = new Article();