<?php
session_start();
if(isset($_SESSION['adminafricahelp']) and isset($_POST['id'])){
    // include function
    include_once "../assets/function/function.php";

    //Include Connexion
    include_once '../class/Connexion.class.php';
    include_once "../class/Admin.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));
    $etat = 0;
    $upd = $admin->updateBloquer($etat,$id);
    if($upd >0){
        echo 'ok';
    }
}