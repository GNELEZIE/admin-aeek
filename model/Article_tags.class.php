<?php
class Article_tags{
  public function __construct() {
      $this->bdd = bdd();
  }


// Create

    public function addArticle_tags($dateArtTag,$article_id ,$tag_id){
        $query = "INSERT INTO article_tags(date_article_tags,article_id ,tag_id)
            VALUES (:dateArtTag,:article_id,:tag_id)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateArtTag" => $dateArtTag,
            "article_id" => $article_id ,
            "tag_id" => $tag_id
        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


// Read
    public function getitagById($id){
        $query = "SELECT * FROM tag
        WHERE id_tag = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllTag(){
        $query = "SELECT * FROM tag
          ORDER BY id_tag  DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }



    public function getitagBySlug($slug){
        $query = "SELECT * FROM tag
        WHERE slug = :slug";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slug" => $slug
        ));
        return $rs;
    }

    //Update

    public function updateTag($nom,$slug,$id){
        $query = "UPDATE tag
                 SET nom = :nom, slug = :slug
           WHERE id_tag = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "nom" => $nom,
            "slug" => $slug,
            "id" => $id

        ));
        $nb = $rs->rowCount();
        return $nb;
    }

    // Delete
    public function deleteTag($id){

        $query = "DELETE  FROM tag WHERE id_tag  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function veriftag($propriete,$val){
        $query = "SELECT * FROM tag WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }




}

$article_tags = new Article_tags();