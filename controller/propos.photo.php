<?php
session_start();
if(isset($_SESSION['useraeek'])){
    $data_info = '';
    $data_photo = '';
    extract($_POST);
    // include function
    include_once "../function/domaine.php";
    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Propos.class.php";
    $idPropos =  htmlentities(trim(addslashes($idPropos)));
    $res = $propos->getProposById()->fetch();

    $ex_photo = $res['photo'];
    if(empty($_FILES['couverture']['name'])){
        $photo = $res['photo'];
    }else{
        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.',$_FILES['couverture']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
//            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassere-v1/uploads/' . $photo;
            $tmp_name = $_FILES['couverture']['tmp_name'];

            if(move_uploaded_file($tmp_name,$destination)){
                if($ex_photo  != ''){
//                    $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $ex_photo;
                    $destination = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassere-v1/uploads/' . $photo;
                    if(file_exists($fichier)){
                        unlink($fichier);
                    }
                }
            }
        }
    }
    $update = $propos->updateProposPhoto($photo,$idPropos);
    if($update >0){
        $data = $propos->getProposById($idPropos)->fetch();
        $data_info = 'ok';
        $data_photo = $domaine.'/uploads/'.$data['photo'];
    }
    $output = array(
        'data_info' => $data_info,
        'data_photo' => $data_photo
    );
    echo json_encode($output);
}
