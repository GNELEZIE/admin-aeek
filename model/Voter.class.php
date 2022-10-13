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


    //Count
    public function getNbrVote(){
        $query = "SELECT COUNT(*) as nb FROM voter";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    // Verification valeur existant
    public function verifUtilisateur($propriete,$val){

        $query = "SELECT * FROM admin WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }




}
// Instance

$voter = new Voter();