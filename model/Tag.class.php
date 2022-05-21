<?php
class Tag{
  public function __construct() {
      $this->bdd = bdd();
  }


// Create

    public function addTag($dateTag,$nom,$slug){
        $query = "INSERT INTO tag(date_tag,nom,slug)
            VALUES (:dateTag,:nom,:slug)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateTag" => $dateTag,
            "nom" => $nom,
            "slug" => $slug

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

$tag = new Tag();