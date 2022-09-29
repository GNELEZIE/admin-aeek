<?php
class Flash{
  public function __construct() {
      $this->bdd = bdd();
  }


// Create

    public function addFlash($date_flash,$titre,$slug,$sous_titre,$date_event,$photo){
        $query = "INSERT INTO flash(date_flash,titre,slug,sous_titre,date_event,photo)
            VALUES (:date_flash,:titre,:slug,:sous_titre,:date_event,:photo)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "date_flash" => $date_flash,
            "titre" => $titre,
            "slug" => $slug,
            "sous_titre" => $sous_titre,
            "date_event" => $date_event,
            "photo" => $photo

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


// Read
    public function getFlashyId($id){
        $query = "SELECT * FROM flash
        WHERE id_flash = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllFlash(){
        $query = "SELECT * FROM flash
          ORDER BY id_flash   DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }



    // Delete
    public function deleteFlash($id){

        $query = "DELETE  FROM flash WHERE id_flash  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function verifFlash($propriete,$val){
        $query = "SELECT * FROM flash WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }




}

$flash = new Flash();