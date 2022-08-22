<?php
class Propos{
  public function __construct() {
      $this->bdd = bdd();
  }


// Create

    public function addPropos($datePop,$titre,$sous_titre,$descript,$photo){
        $query = "INSERT INTO propos(date_propos,titre,sous_titre,description,photo)
            VALUES (:datePop,:titre,:sous_titre,:descript,:photo)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "datePop" => $datePop,
            "titre" => $titre,
            "sous_titre" => $sous_titre,
            "descript" => $descript,
            "photo" => $photo

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


// Read
    public function getProposById($id){
        $query = "SELECT * FROM propos
        WHERE id_propos = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllpropos(){
        $query = "SELECT * FROM propos
          ORDER BY id_propos   DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }



    // Delete
    public function deleteBan($id){

        $query = "DELETE  FROM propos WHERE id_propos  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Update

    public function updatePropos($titre,$sous_titre,$description,$id){
        $query = "UPDATE propos
                 SET titre = :titre, sous_titre =:sous_titre, description =:description
                 WHERE id_propos = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "titre" => $titre,
            "sous_titre" => $sous_titre,
            "description" => $description,
            "id" => $id

        ));
        $nb = $rs->rowCount();
        return $nb;
    }
    public function updateProposPhoto($photo,$id){
        $query = "UPDATE propos
            SET photo = :photo
            WHERE id_propos = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "photo" => $photo,
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

$propos = new Propos();