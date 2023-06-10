<?php
class Gallerie{
    public function __construct() {
        $this->bdd = bdd();
    }


// Create

    public function addGallerie($date_gallerie,$photo,$event_id){
        $query = "INSERT INTO gallerie(date_gallerie,photo,event_id)
            VALUES (:date_gallerie,:photo,:event_id)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "date_gallerie" => $date_gallerie,
            "photo" => $photo,
            "event_id" => $event_id
        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


// Read
    public function getGallerieById($id){
        $query = "SELECT * FROM gallerie
        WHERE event_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    public function getBalerieBySlug($slugs){
        $query = "SELECT * FROM gallerie
        WHERE slug = :slugs";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slugs" => $slugs
        ));
        return $rs;
    }
   public function getEventBySlug($slugs){
        $query = "SELECT * FROM events
        WHERE slug = :slugs";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slugs" => $slugs
        ));
        return $rs;
    }
   public function getEventsBySlug($slugs){
        $query = "SELECT * FROM events
        WHERE slug = :slugs";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slugs" => $slugs
        ));
        return $rs;
    }
    public function getEventById($id){
        $query = "SELECT * FROM gallerie
        WHERE id_gallerie = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }
    public function getEventByEventsId($id){
        $query = "SELECT * FROM gallerie
        WHERE event_id = :id";
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

    //Count

    public function nbPhotoByEvents($eventId){
        $query = "SELECT COUNT(*) as nb FROM gallerie
        WHERE event_id = :eventId ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "eventId" => $eventId

        ));
        return $rs;
    }

    // Delete
    public function deleteGallerie($id){

        $query = "DELETE  FROM gallerie WHERE id_gallerie = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    public function deleteGallerieByEventId($id){

        $query = "DELETE  FROM gallerie WHERE event_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function verifEvents($propriete,$val){
        $query = "SELECT * FROM events WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }




}

$gallerie = new Gallerie();