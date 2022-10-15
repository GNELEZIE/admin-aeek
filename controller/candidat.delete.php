<?php
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $data = $candidat->getCandidatById($id)->fetch();
    $delete = $candidat->deleteCandidat($id);
    if($delete > 0){
        if($data['photo'] != ''){
            $fichier = $_SERVER['DOCUMENT_ROOT'].'/aeek-kassere.com/uploads/'.$data['photo'];
//            $fichier = $_SERVER['DOCUMENT_ROOT'].'/www/aeek-kassere-v1/uploads/'.$data['photo'];
            if(file_exists($fichier)){
                unlink($fichier);
            }
        }
        echo 'ok';
    }
}