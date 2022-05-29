<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){
    // include function
    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Admin.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));
    $dts = $admin->getAdminById($id)->fetch();

        $etat = 2;


    $upd = $admin->updateBloquer($etat,$id);
    if($upd >0){
        echo 'ok';
    }
}