<?php

    // include function
    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Emplois.class.php";


    $etat = 1;

$list = $emplois->getAllEmplois();
  while($expire = $list->fetch()){
      $expDate = date_fr($expire['date_fin']);
      $toDate = date_fr($dateGmt);
//      echo $expDate .' = '.$toDate;
      if($expDate == $toDate){
          $upd = $emplois->updateEmplois($etat,$expire['id_emplois']);
      }
  }


