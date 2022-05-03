<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek'])  and isset($_POST['udpCat']) and isset($_POST['idCat']) and isset($_SESSION['myformkey']) and isset($_POST['formkeys']) and $_SESSION['myformkey'] == $_POST['formkeys']){


//Include function
    include_once "../function/function.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Categorie.class.php';

    $slug = create_slug($_POST['udpCat']);
    extract($_POST);
    $udpCat = htmlentities(trim(addslashes($udpCat)));
    $idCat = htmlentities(trim(addslashes($idCat)));

    $propriete1 = "nom";
    $verifSlug = $categorie->verifCategorie($propriete1,$udpCat);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }
    $save = $categorie->updateCategorie($udpCat,$slug,$idCat);
    if($save > 0){
        $info = 'ok';
    }

}
$output = array(
    'data_info' => $info
);
echo json_encode($output);