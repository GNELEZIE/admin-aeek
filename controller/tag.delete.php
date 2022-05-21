<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Tag.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $tag->deleteTag($id);
    if($delete > 0){
        echo 'ok';
    }
}