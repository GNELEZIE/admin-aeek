<?php
if(isset($_SESSION['useraeek']) and isset($_POST['titreudp']) and isset($_POST['artIds']) and isset($_POST['descriptionudp']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

    extract($_POST);
    $categorie = 13;
    $descriptionudp = htmlentities(trim(addslashes($descriptionudp)));
    $titreudp = htmlentities(trim(addslashes($titreudp)));
    $artIds = htmlentities(trim(addslashes($artIds)));

    $upd= $article->updateArticleInfo($titreudp,$categorie,$descriptionudp,$artIds);
    if($upd > 0){
        $succes['message'] = 'Votre article a été modifié avec succès';
    }

}
