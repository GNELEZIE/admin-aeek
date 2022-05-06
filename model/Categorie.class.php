<?php
class Categorie{
  public function __construct() {
      $this->bdd = bdd();
  }


// Create

    public function addCategorie($dateCat,$nom,$slug){
        $query = "INSERT INTO categorie(date_categorie,nom,slug)
            VALUES (:dateCat,:nom,:slug)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateCat" => $dateCat,
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
    public function getCategorieById($id){
        $query = "SELECT * FROM categorie
        WHERE id_categorie = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllCategorie(){
        $query = "SELECT * FROM categorie
          ORDER BY id_categorie  DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }



    public function getCategorieBySlug($slug){
        $query = "SELECT * FROM categorie
        WHERE slug = :slug";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slug" => $slug
        ));
        return $rs;
    }

    //Update

    public function updateCategorie($nom,$slug,$id){
        $query = "UPDATE categorie
                 SET nom = :nom, slug = :slug
           WHERE id_categorie = :id ";
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
    public function deleteCat($id){

        $query = "DELETE  FROM categorie WHERE id_categorie  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function verifCategorie($propriete,$val){
        $query = "SELECT * FROM categorie WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }




}

$categorie = new Categorie();