<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['artId'])){
    $data_info = '';
    $data_photo = '';
    extract($_POST);
    // include function
    include_once "../function/domaine.php";
    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Article.class.php";
   $artId =  htmlentities(trim(addslashes($artId)));
    $res = $article->getArticleById($artId)->fetch();

    $ex_photo = $res['couverture'];
    if(empty($_FILES['userImg']['name'])){
        $photo = $res['couverture'];
    }else{
        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.',$_FILES['userImg']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
//            $destination = '../uploads/'.$photo;
            $tmp_name = $_FILES['userImg']['tmp_name'];

            if(move_uploaded_file($tmp_name,$destination)){
                if($ex_photo  != ''){
                    $fichier ='../uploads/'.$ex_photo;
                    if(file_exists($fichier)){
                        unlink($fichier);
                    }
                }
            }
        }
    }
    $update = $article->updateCouverturePhoto($photo,$artId);
    if($update >0){
        $data = $article->getArticleById($artId)->fetch();
        $data_info = 'ok';
        $data_photo = $domaine_admin.'/uploads/'.$data['couverture'];
    }
    $output = array(
        'data_info' => $data_info,
        'data_photo' => $data_photo
    );
    echo json_encode($output);
}
