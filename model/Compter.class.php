<?php

class Compter{
    public function  __construct(){
        $this->bdd = bdd();
    }



    //Read
    public function getAllVus(){
        $query = "SELECT * FROM stats_visite";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function SommeVus(){
        $query = "SELECT SUM(pages_vues) nb FROM stats_visite";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function nbVisiteurs(){

        $query = "SELECT COUNT(*) as nb FROM stats_visite";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function nbByBrowser($browser){
        $query = "SELECT  SUM(pages_vues) as sm FROM stats_visite
        WHERE navigateur = :browser";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "browser" => $browser
        ));
        return $rs;
    }

}

$compter = new Compter();