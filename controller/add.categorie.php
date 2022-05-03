<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek']) and isset($_POST['cat']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

//Include function
    include_once "../function/function.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Categorie.class.php';

    $slug = create_slug($_POST['cat']);
    extract($_POST);
    $cat = htmlentities(trim(addslashes($cat)));

    $propriete1 = "nom";
    $verifSlug = $categorie->verifCategorie($propriete1,$cat);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }
    $save = $categorie->addCategorie($dateGmt,$cat,$slug);
   if($save > 0){
       $info = 'ok';
   }

}
$output = array(
    'data_info' => $info
);
echo json_encode($output);