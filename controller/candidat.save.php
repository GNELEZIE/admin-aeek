<?php
if(isset($_SESSION['useraeek'])   and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    $data_info = '';
    $data_photo = '';
    extract($_POST);

    $nom =  htmlentities(trim(addslashes($nom)));
    $prenom =  htmlentities(trim(addslashes($prenom)));
    $fonction =  htmlentities(trim(addslashes($fonction)));
    $bio =  htmlentities(trim(addslashes($bio)));



        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.',$_FILES['couverture']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $tmp_name = $_FILES['couverture']['tmp_name'];
            move_uploaded_file($tmp_name, $destination);
    }
    $data_info = 'ok';

    $save = $candidat->addCandidat($dateGmt,$nom,$prenom,$fonction,$bio,$photo);
    if($save >0){
        $data_info = 'ok';
    }
    $output = array(
        'data_info' => $data_info,
        'data_photo' => $data_photo
    );
    echo json_encode($output);
}
