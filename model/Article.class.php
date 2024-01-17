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

    public function getArticleById($id){
        $query = "SELECT * FROM article
        WHERE id_article = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }
    public function getArticleByUserId($userId){
        $query = "SELECT * FROM article
        WHERE user_id = :userId ORDER BY id_article DESC LIMIT 10";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "userId" => $userId
        ));
        return $rs;
    }
    public function getArticleBySlug($slug){
        $query = "SELECT * FROM article
        WHERE slug = :slug";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slug" => $slug
        ));
        return $rs;
    }

    //Count

    public function getAllNbrArticleByUser($id){
        $query = "SELECT COUNT(*) as nb FROM article
                   WHERE user_id =:id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllNbrArticleByUserAndComment($id){
        $query = "SELECT COUNT(*) as nb FROM comment
                  INNER JOIN article  ON id_article = article_id
                   WHERE user_id =:id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllNbrArticle(){
        $query = "SELECT COUNT(*) as nb FROM article";
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
    public function updateArticleInfo($titre,$categorie_id,$description,$id){
        $query = "UPDATE article
            SET titre = :titre,categorie_id = :categorie_id, description =:description
            WHERE id_article = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "titre" => $titre,
            "categorie_id" => $categorie_id,
            "description" => $description,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

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
    // Verification valeur existant
    public function verifArticle($propriete,$val){
        $query = "SELECT * FROM article WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }

    // Delete
    public function deleteArticle($id){

        $query = "DELETE  FROM article WHERE id_article  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }









}

$article = new Article();