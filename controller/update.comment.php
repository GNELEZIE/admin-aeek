<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek'])  and isset($_POST['message']) and isset($_POST['idComment']) and isset($_SESSION['myformkey']) and isset($_POST['formkeys']) and $_SESSION['myformkey'] == $_POST['formkeys']){

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Comment.class.php';

    extract($_POST);
    $message = htmlentities(trim(addslashes($message)));
    $idComment = htmlentities(trim(addslashes($idComment)));

    $upd = $comment->updateComment($message,$idComment);
    if($upd > 0){
        $info = 'ok';
    }

}
$output = array(
    'data_info' => $info
);
echo json_encode($output);