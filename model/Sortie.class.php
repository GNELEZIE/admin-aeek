<?php
class Sortie {
    public  function  __construct(){
        $this->bdd = bdd();
    }

//Read

//Table caofa

    public function getAllCaofa(){
        $query = "SELECT * FROM caofa ORDER BY id_caofa DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    //Count
    public function getNbrCaofa(){
        $query = "SELECT COUNT(*) as nb FROM caofa";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function deleteCaofa($id){

        $query = "DELETE  FROM caofa WHERE id_caofa = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }














    public function getAllInscript(){
        $query = "SELECT * FROM sortie ORDER BY id_sortie DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    //Count
    public function getNbrSortie(){
        $query = "SELECT COUNT(*) as nb FROM sortie";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function getNbrSortieByTpes($tps){
        $query = "SELECT COUNT(*) as nb FROM sortie
                WHERE membre =:tps";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "tps" => $tps
        ));
    }

    public function getNbrSortieByTpe($mbre){
        $query = "SELECT COUNT(*) as nb FROM sortie
        WHERE membre = :mbre";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "mbre" => $mbre
        ));
        return $rs;
    }

    // Verification valeur existant
    public function verifInscrit($propriete,$val){
        $query = "SELECT * FROM sortie WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }

    // Delete
    public function deleteInscrit($id){

        $query = "DELETE  FROM sortie WHERE id_sortie = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }


}
// Instance

$sortie = new Sortie();