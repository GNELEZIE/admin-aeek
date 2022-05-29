<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Admin.class.php";


    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));
    $data = $admin->getAdminById($id)->fetch();
    $delete = $admin->deleteAdmin($id);

    if($delete > 0){
        $fichier = '../uploads/'.$data['photo'];
        if(file_exists($fichier)){
            unlink($fichier);
        }
        echo 'ok';
    }
}