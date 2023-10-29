<?php
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $voter->deleteVotant($id);

    echo 'ok';

}