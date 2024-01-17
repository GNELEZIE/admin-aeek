<?php
if(isset($_SESSION['useraeek'])){
    $liste = $user->getAllUserReunion();


}else{

    header('location:connexion');
    exit();

}

include_once 'model.imprimer.php';

?>