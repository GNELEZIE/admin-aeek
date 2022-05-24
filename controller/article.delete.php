<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){


    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Article.class.php";
    include_once "../model/Comment.class.php";
    include_once "../model/Reponse.class.php";
    include_once "../model/Article_tags.class.php";

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));
    $data = $article->getArticleById($id)->fetch();
    $delete = $article->deleteArticle($id);

    if($delete > 0){
        $deleteCom = $comment->deleteCommentByArticle($id);
        $deleteResponse = $reponse->deleteReponseByArticle($id);
        $deleteArtTag = $article_tags->deleteArtTag($id);
        $fichier = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassre/uploads/'.$data['couverture'];
        if(file_exists($fichier)){
            unlink($fichier);
        }
        echo 'ok';
    }
}