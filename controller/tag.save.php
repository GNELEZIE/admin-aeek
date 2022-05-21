<?php
session_start();
$info = '';
if(isset($_SESSION['useraeek']) and isset($_POST['tags']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

//Include function
    include_once "../function/function.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Tag.class.php';

    $slug = create_slug($_POST['tags']);
    extract($_POST);
    $tags = htmlentities(trim(addslashes($tags)));

    $propriete1 = "nom";
    $verifSlug = $tag->veriftag($propriete1,$tags);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }
    $save = $tag->addTag($dateGmt,$tags,$slug);
   if($save > 0){
       $info = 'ok';
   }

}
$output = array(
    'data_info' => $info
);
echo json_encode($output);