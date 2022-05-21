<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek'])  and isset($_POST['udpTag']) and isset($_POST['idTag']) and isset($_SESSION['myformkey']) and isset($_POST['formkeys']) and $_SESSION['myformkey'] == $_POST['formkeys']){


//Include function
    include_once "../function/function.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Tag.class.php';

    $slug = create_slug($_POST['udpTag']);
    extract($_POST);
    $udpTag = htmlentities(trim(addslashes($udpTag)));
    $idTag = htmlentities(trim(addslashes($idTag)));

    $propriete1 = "nom";
    $verifSlug = $tag->veriftag($propriete1,$udpTag);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }
    $save = $tag->updateTag($udpTag,$slug,$idTag);
    if($save > 0){
        $info = 'ok';
    }

}
$output = array(
    'data_info' => $info
);
echo json_encode($output);