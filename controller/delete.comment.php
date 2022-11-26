<?php

if(isset($_SESSION['useraeek']) and isset($_POST['id'])){

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $comment->deleteComment($id);
    if($delete > 0){
        $deleteResponse = $reponse->deleteReponse($id);
        echo 'ok';
    }
}