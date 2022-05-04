<?php
session_start();
$info ='';
if(isset($_SESSION['useraeek']) and isset($_POST['titre']) and isset($_POST['categorie']) and isset($_POST['summernote']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

// include function

    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Categorie.class.php";
    include_once "../model/Article.class.php";
    $slug = create_slug($_POST['titre']);
    $summernote = filter_var(htmlentities($_POST['summernote']),FILTER_SANITIZE_STRING);
    extract($_POST);
    $titre = htmlentities(trim(addslashes($titre)));
//    $summernote = htmlentities(($summernote));
    $categorie = htmlentities(trim(addslashes($categorie)));
    $titre = htmlentities(trim(addslashes($titre)));
    $titre = htmlentities(trim(addslashes($titre)));
    $titre = htmlentities(trim(addslashes($titre)));
    $description ='';
    $propriete1 = "titre";
    $verifSlug = $article->verifArticle($propriete1,$titre);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }

    if(isset($_FILES['couverture']['name'])) {
        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.', $_FILES['couverture']['name']);
        $photo_ext = strtolower(end($photo_ext));
        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid() . '.' . $photo_ext;
            $destination = '../uploads/' . $photo;
            $tmp_name = $_FILES['couverture']['tmp_name'];
            move_uploaded_file($tmp_name, $destination);
        } else {
            $info = '1';
        }

    }

    $save= $article->addArticle($dateGmt,$titre,$categorie,$summernote,$photo,$slug,$_SESSION['useraeek']['id_admin']);
    if($save > 0){
        $info = 'ok';
    }

}

$output = array(
    'data_info' => $info
);
echo json_encode($output);
