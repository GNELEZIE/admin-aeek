<?php

class Compter{
    public function  __construct(){
        $this->bdd = bdd();
    }



    //Read

    public function SommeVus(){
        $query = "SELECT SUM(pages_vues) nb FROM stats_visite";
        $rs = $this->bdd->query($query);
        return $rs;
    }


}

$compter = new Compter();