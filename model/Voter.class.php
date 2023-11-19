<?php
class Voter {
    public  function  __construct(){
        $this->bdd = bdd();
    }


// Create

    public function voterAdd($dateVote ,$id_candidat){
        $ip   = $_SERVER['REMOTE_ADDR']; // L'adresse IP du visiteur
        $query = "INSERT INTO voter(date_vote,ip ,id_candidat)
            VALUES (:dateVote,:ip,:id_candidat)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateVote" => $dateVote,
            "ip" => $ip,
            "id_candidat" => $id_candidat
        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }
    // Read

    public function getVoterByIp($id){

        $query = "SELECT * FROM voter
        WHERE ip = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }
    public function getAllVote(){
        $query = "SELECT * FROM voter ORDER id_voter DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }

// INNER JOIN


    public function getCandidatByVotantId($id){
        $query = "SELECT * FROM voter
                  INNER JOIN candidat ON id_candidat = candidat_id
                  WHERE id_voter = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;

    }



    public function getAllVotants(){
        $query = "SELECT * FROM voter
                  INNER JOIN candidat ON id_candidat = candidat_id ORDER BY id_voter DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function getAllVotant(){
        $query = "SELECT * FROM voter
                  INNER JOIN candidat ON id_candidat = candidat_id
                  WHERE an = 23 ORDER id_voter DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }


    //Count
    public function getNbrVote(){
        $query = "SELECT COUNT(*) as nb FROM voter
                  WHERE an = 23";
        $rs = $this->bdd->query($query);

        return $rs;
    }


    // Delete
    public function deleteVotant($id){

        $query = "DELETE  FROM voter WHERE id_voter = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }



}
// Instance

$voter = new Voter();