<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek']) and isset($_POST['idCommentR'])  and isset($_POST['reponses']) and isset($_POST['art_id']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);
    //Include function
    include_once "../function/function.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Reponse.class.php';

    $reponses = htmlentities(trim(addslashes($reponses)));
    $idCommentR = htmlentities(trim(addslashes($idCommentR)));
    $art_id = htmlentities(trim(addslashes($art_id)));
    $save= $reponse->addReponse($dateGmt,$_SESSION['useraeek']['nom'],$_SESSION['useraeek']['email'],$reponses,$idCommentR,$art_id);

    if($save > 0){
        $info = 'ok';
    }
}

$output = array(
    'data_info' => $info
);
echo json_encode($output);