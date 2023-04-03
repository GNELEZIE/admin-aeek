<?php
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $sortie->deleteInscrit($id);
    if($delete > 0){
        echo 'ok';
    }
}