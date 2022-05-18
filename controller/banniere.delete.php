<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Banniere.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $data = $banniere->getBanById($id)->fetch();
    $delete = $banniere->deleteBan($id);
    if($delete > 0){
        if($data['photo'] != ''){
            $fichier = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassre/uploads/'.$data['photo'];
            if(file_exists($fichier)){
                unlink($fichier);
            }
        }
        echo 'ok';
    }
}