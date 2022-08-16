<?php

if(isset($_SESSION['useraeek']) and isset($_POST['nom']) and isset($_POST['lien']) and isset($_POST['dateDebut']) and isset($_POST['dateFin']) and isset($_POST['categorie']) and isset($_POST['description']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){


    $slug = create_slug($_POST['nom']);
    extract($_POST);

    $nom = htmlentities(trim(addslashes($nom)));
    $lien = htmlentities(trim(addslashes($lien)));
    $dateDebut = date_eng($_POST['dateDebut']);
    $dateFin = date_eng($_POST['dateFin']);
    $categorie = htmlentities(trim(addslashes($categorie)));
    $description = htmlentities(trim(addslashes($description)));

    $propriete1 = "nom";
    $verifSlug = $emplois->verifEmplois($propriete1,$nom);
    $nbSlug =$verifSlug->rowCount();
    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }

    if(isset($_FILES['logo']['name'])) {
        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.', $_FILES['logo']['name']);
        $photo_ext = strtolower(end($photo_ext));
        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid() . '.' . $photo_ext;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $tmp_name = $_FILES['logo']['tmp_name'];
            move_uploaded_file($tmp_name, $destination);
        } else {
            $errors['publier'] = 'Impossible de publier l\'offre format de l\'image incorrect!';
        }

    }

    $save= $emplois->addEmplois($dateGmt,$nom,$lien,$dateDebut,$dateFin,$description,$categorie,$photo,$slug);
    if($save > 0){
        $success['message'] = 'Votre article a été publié avec succès <a href="'.$domaine.'/emplois" target="_blank">Voir l\'offre</a>';
    }

}
