<?php
class Banniere{
  public function __construct() {
      $this->bdd = bdd();
  }


// Create

    public function addBanniere($dateBan,$titre,$sous_titre,$photo){
        $query = "INSERT INTO banniere(date_banniere,titre,sous_titre,photo)
            VALUES (:dateBan,:titre,:sous_titre,:photo)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateBan" => $dateBan,
            "titre" => $titre,
            "sous_titre" => $sous_titre,
            "photo" => $photo

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


// Read
    public function getBanById($id){
        $query = "SELECT * FROM banniere
        WHERE id_banniere = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllBanniere(){
        $query = "SELECT * FROM banniere
          ORDER BY id_banniere   DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }



    // Delete
    public function deleteBan($id){

        $query = "DELETE  FROM banniere WHERE id_banniere  = :id";
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

$banniere = new Banniere();