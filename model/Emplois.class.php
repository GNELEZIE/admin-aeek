<?php

class Emplois{
    public function  __construct(){
        $this->bdd = bdd();
    }

    // Create

    public function addEmplois($date_emplois,$nom,$lien_detail,$date_debut,$date_fin,$description,$type_offre,$logo,$slug){
        $query = "INSERT INTO emplois(date_emplois,nom,lien_detail,date_debut,date_fin,description,type_offre,logo,slug)
            VALUES (:date_emplois,:nom,:lien_detail,:date_debut,:date_fin,:description,:type_offre,:logo,:slug)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "date_emplois" => $date_emplois,
            "nom" => $nom,
            "lien_detail" => $lien_detail,
            "description" => $description,
            "date_debut" => $date_debut,
            "date_fin" => $date_fin,
            "type_offre" => $type_offre,
            "logo" => $logo,
            "slug" => $slug

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }

    //Read
    public function getAllEmplois(){
        $query = "SELECT * FROM emplois
          ORDER BY id_emplois DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function getAllEmploisActive(){
        $query = "SELECT * FROM emplois
                  WHERE statut =!1 ORDER BY id_emplois DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }


    //Count
    public function nbEmplois(){

        $query = "SELECT COUNT(*) as nb FROM emplois
                  WHERE statut =!1 ";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function getEmploisById($id){
        $query = "SELECT * FROM emplois
        WHERE id_emplois = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));
        return $rs;
    }

    //Update
    public function updateEmplois($etat,$id){
        $query = "UPDATE emplois
            SET statut = :etat
            WHERE id_emplois = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    public function expireEmplois($etat){
        $query = "UPDATE emplois
            SET statut = :etat";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat

        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    // Verification valeur existant
    public function verifEmplois($propriete,$val){
        $query = "SELECT * FROM emplois WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }

    // Delete
    public function deleteEmplois($id){

        $query = "DELETE  FROM emplois WHERE id_emplois = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }









}

$emplois = new Emplois();