<?php


if(isset($_SESSION['useraeek'])  and isset($_POST['id'])){


    extract($_POST);
    $id = htmlentities(trim(addslashes($id)));
    $etat = 1;

    $upd = $comment->updateStatutComment($etat,$id);
    if($upd >0){
        echo 'ok';
    }
}
