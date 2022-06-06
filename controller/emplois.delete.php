<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Events.class.php";
    include_once "../model/Emplois.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $dat = $emplois->getEmploisById($id)->fetch();
    $delete = $emplois->deleteEmplois($id);

    if($delete > 0){
        if($dat['logo'] != ''){
            $fichier = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassre/uploads/'.$dat['logo'];
            if(file_exists($fichier)){
                unlink($fichier);
            }
        }

        echo 'ok';
    }
}