<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Events.class.php";
    include_once "../model/Gallerie.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $dat = $gallerie->getEventByEventsId($id);
    $delete = $events->deleteEvent($id);

    if($delete > 0){
        $deleteGal = $gallerie->deleteGallerieByEventId($id);
        while($data = $dat->fetch()){
            $fichier = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassre/uploads/'.$data['photo'];
            if(file_exists($fichier)){
                unlink($fichier);
            }
        }

        echo 'ok';
    }
}