<?php
//session_start();
//$info ='';
//echo $_SESSION['myformkey'] .'=='. $_POST['formkey'];
if(isset($_SESSION['useraeek']) and isset($_POST['titre']) and isset($_POST['categorie']) and isset($_POST['artIds']) and isset($_POST['summernote']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

    $summernote = filter_var(htmlentities($_POST['summernote']),FILTER_SANITIZE_STRING);
    extract($_POST);

//    $summernote = htmlentities(($summernote));
    //

    $categorie = htmlentities(trim(addslashes($categorie)));
    $titre = htmlentities(trim(addslashes($titre)));
    $artIds = htmlentities(trim(addslashes($artIds)));

    $upd= $article->updateArticleInfo($titre,$categorie,$summernote,$artIds);
    if($upd > 0){
        $success['message'] = 'Votre article a été modifié avec succès <a href="'.$domaine.'/show/'.$slug.'" target="_blank">Voir l\'article</a>';
    }

}

//$output = array(
//    'data_info' => $info
//);
//echo json_encode($output);
