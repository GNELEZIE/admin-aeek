<?php
session_start();
if(isset($_SESSION['useraeek']) and isset($_POST['event_id'])){

    extract($_POST);
//Include function
    include_once "../function/function.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Gallerie.class.php';

    $event_id = htmlentities(trim(addslashes($event_id)));
    if(!empty($_FILES['photo']['name'])){
        $extensionValide = array('jpeg', 'jpg', 'png');

        $photo_ext = explode('.',$_FILES['photo']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $tmp_name = $_FILES['photo']['tmp_name'];

            if(move_uploaded_file($tmp_name,$destination)){
                $save = $gallerie->addGallerie($dateGmt,$photo,$event_id);
                if($save >0){
                    echo 'ok';
                }
            }
        }
    }


}
