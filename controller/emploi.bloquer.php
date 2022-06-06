<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){
    // include function
    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Emplois.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));
    $etat = 1;

    $upd = $emplois->updateEmplois($etat,$id);
    if($upd >0){
        echo 'ok';
    }
}