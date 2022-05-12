<?php
session_start();

if(isset($_SESSION['useraeek'])  and isset($_POST['id'])){

    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Comment.class.php";

    extract($_POST);
    $id = htmlentities(trim(addslashes($id)));
    $etat = 1;

    $upd = $comment->updateStatutComment($etat,$id);
    if($upd >0){
        echo 'ok';
    }
}
