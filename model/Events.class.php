<?php
class Events{
    public function __construct() {
        $this->bdd = bdd();
    }


// Create

    public function addEvents($dateEvent,$nom){
        $query = "INSERT INTO events(date_events,nom)
            VALUES (:dateEvent,:nom)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateEvent" => $dateEvent,
            "nom" => $nom,

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


// Read
    public function getEventById($id){
        $query = "SELECT * FROM events
        WHERE id_events = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getAllEvents(){
        $query = "SELECT * FROM events
          ORDER BY id_events    DESC ";
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

$events = new Events();