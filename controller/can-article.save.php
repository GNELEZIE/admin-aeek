<?php

if(isset($_SESSION['useraeek']) and isset($_POST['titre']) and isset($_POST['description']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $slug = create_slug($_POST['titre']);
    $categorie = 13;
    $description = htmlentities(trim(addslashes($description)));
    $titre = htmlentities(trim(addslashes($titre)));

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
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $tmp_name = $_FILES['couverture']['tmp_name'];
            move_uploaded_file($tmp_name, $destination);
        } else {
            $errors['publier'] = 'Impossible de publier l\'article format de l\'image incorrect!';
        }

    }

    $save= $article->addArticle($dateGmt,$titre,$categorie,$description,$photo,$slug,$_SESSION['useraeek']['id_admin']);
    if($save > 0){
        $success['message'] = 'Votre article a été publié avec succès <a href="'.$domaine.'/blog/'.$slug.'" target="_blank">Voir l\'article</a>';
        $value = 10;
        $save= $article_tags->addArticle_tags($dateGmt,$save,$value);
    }

}

