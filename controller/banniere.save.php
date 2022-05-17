<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['titre']) and isset($_POST['sous_titre'])  and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    $data_info = '';
    $data_photo = '';
    extract($_POST);
    // include function
    include_once "../function/domaine.php";
    include_once "../function/function.php";

    //Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Banniere.class.php";

    $titre =  htmlentities(trim(addslashes($titre)));
    $sous_titre =  htmlentities(trim(addslashes($sous_titre)));


        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.',$_FILES['couverture']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassre/uploads/'.$photo;
            $tmp_name = $_FILES['couverture']['tmp_name'];
            move_uploaded_file($tmp_name, $destination);
    }
    $data_info = 'ok';

    $save = $banniere->addBanniere($dateGmt,$titre,$sous_titre,$photo);
    if($save >0){
        $data_info = 'ok';
    }
    $output = array(
        'data_info' => $data_info,
        'data_photo' => $data_photo
    );
    echo json_encode($output);
}
