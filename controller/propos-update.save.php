<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['formkeys']) and $_SESSION['myformkey'] == $_POST['formkeys']){
    $data_info = '';
    extract($_POST);
    // include function

    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Propos.class.php";

    $titres =  htmlentities(trim(addslashes($titres)));
    $sous_titres =  htmlentities(trim(addslashes($sous_titres)));
    $descriptions =  htmlentities(trim(addslashes($descriptions)));
    $idProp =  htmlentities(trim(addslashes($idProp)));
    $upd = $propos->updatePropos($titres,$sous_titres,$descriptions,$idProp);

    if($upd >0){
        $data_info = 'ok';
    }
    $output = array(
        'data_info' => $data_info,
    );
    echo json_encode($output);
}
