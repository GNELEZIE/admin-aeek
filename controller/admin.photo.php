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
    include_once "../model/Admin.class.php";
    $artId =  htmlentities(trim(addslashes($artId)));
    $res = $admin->getAdminById($_SESSION['useraeek']['id_admin'])->fetch();

    $ex_photo = $res['photo'];
    if(empty($_FILES['userImg']['name'])){
        $photo = $res['photo'];
    }else{
        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.',$_FILES['userImg']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $tmp_name = $_FILES['userImg']['tmp_name'];

            if(move_uploaded_file($tmp_name,$destination)){
                if($ex_photo  != ''){
                    $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $ex_photo;
                    if(file_exists($fichier)){
                        unlink($fichier);
                    }
                }
            }
        }
    }
    $update = $admin->updateAdminPhoto($photo,$_SESSION['useraeek']['id_admin']);
    if($update >0){
        $data = $admin->getAdminById($_SESSION['useraeek']['id_admin'])->fetch();
        $data_info = 'ok';
        $data_photo = $domaine_admin.'/uploads/'.$data['photo'];
    }
    $output = array(
        'data_info' => $data_info,
        'data_photo' => $data_photo
    );
    echo json_encode($output);
}
