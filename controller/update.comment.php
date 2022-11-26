<?php

if(isset($_SESSION['useraeek'])  and isset($_POST['message']) and isset($_SESSION['myformkey']) and isset($_POST['formkeys']) and $_SESSION['myformkey'] == $_POST['formkeys']){
    $info = '';

    extract($_POST);
    $message = htmlentities(trim(addslashes($message)));
    $idComment = htmlentities(trim(addslashes($idComment)));
    $etat = 1;

    $upd = $comment->updateComment($message,$idComment);
    $upds = $comment->updateStatutComment($etat,$idComment);
    $info = 'ok';
    if($upd > 0){
        $upds = $comment->updateStatutComment($etat,$idComment);
        $info = 'ok';
    }else{
        $upds = $comment->updateStatutComment($etat,$idComment);
        $info = '1';
    }
    $output = array(
        'data_info' => $info
    );
    echo json_encode($output);
}
