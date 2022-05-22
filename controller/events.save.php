<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek']) and isset($_POST['nom']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

    //Include function
    include_once "../function/function.php";
    $dateEvents = date_eng($_POST['dateEvent']);

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Events.class.php';

    $slug = create_slug($_POST['nom']);
    extract($_POST);
    $nom = htmlentities(trim(addslashes($nom)));


    $propriete1 = "nom";
    $verifSlug = $events->verifEvents($propriete1,$nom);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }
    $save = $events->addEvents($dateGmt,$dateEvents,$nom,$slug);
   if($save > 0){
       $info = 'ok';
   }

}
$output = array(
    'data_info' => $info
);
echo json_encode($output);