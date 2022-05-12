<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Comment.class.php";
    include_once "../model/Reponse.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $comment->deleteComment($id);
    if($delete > 0){
        $deleteResponse = $reponse->deleteReponse($id);
        echo 'ok';
    }
}