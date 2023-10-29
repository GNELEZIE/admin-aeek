<?php
if(isset($_SESSION['useraeek'])   and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    $data_info = '';
    $data_photo = '';
    extract($_POST);

    $nom =  htmlentities(trim(addslashes($nom)));
    $prenom =  htmlentities(trim(addslashes($prenom)));
    $fonction =  htmlentities(trim(addslashes($fonction)));
    $bio =  htmlentities(trim(addslashes($bio)));

    $slug = create_slug($_POST['prenom']);
    $propriete1 = 'prenom';
    $verifSlug = $candidat->verifCandidat($propriete1,$nom);
    $rsSlug = $verifSlug->fetch();
    $nbSlug =$verifSlug->rowCount();
    $an = 23;
    if($nbSlug > 0){
        $slug = $slug.'-'.$nbSlug;
    }

        $extensionValide = array('jpeg', 'jpg', 'png');
        $photo_ext = explode('.',$_FILES['couverture']['name']);
        $photo_ext = strtolower(end($photo_ext));

        if (in_array($photo_ext, $extensionValide)) {
            $photo = uniqid().'.'.$photo_ext;
//            $destination = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassere-v1/uploads/' . $photo;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/' . $photo;
            $tmp_name = $_FILES['couverture']['tmp_name'];
            move_uploaded_file($tmp_name, $destination);
    }

    $save = $candidat->addCandidat($dateGmt,$nom,$prenom,$slug,$fonction,$bio,$photo,$an);
    if($save >0){
        $data_info = 'ok';
    }
    $output = array(
        'data_info' => $data_info,
        'data_photo' => $data_photo
    );
    echo json_encode($output);
}
