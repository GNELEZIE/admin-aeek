<?php
session_start();
$info = '';
//exit;
if(isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['phone']) and isset($_POST['isoPhone']) and isset($_POST['dialPhone'])and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']) {
    extract($_POST);
// include function

    include_once "../function/domaine.php";
    include_once "../function/function.php";
    include_once "../function/mailing.php";

//Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Admin.class.php";


    $nom = htmlentities(trim(addslashes(strip_tags($nom))));
    $prenom = htmlentities(trim(addslashes(strip_tags($prenom))));
    $phone = htmlentities(trim(addslashes(strip_tags($phone))));
    $isoPhone = htmlentities(trim(addslashes($isoPhone)));
    $dialPhone = htmlentities(trim(addslashes($dialPhone)));
    $role = htmlentities(trim(addslashes($role)));
    $date = date('Y-m-d H:i');
    error_reporting(E_ALL ^ E_NOTICE);
    $slug = create_slug($_POST['nom']);
    $propriete1 = 'phone';
    $verifSlug = $admin->verifUtilisateur($propriete1,$phone);
    $rsSlug = $verifSlug->fetch();

    $password = '123456789';
    $blq = 1;

    if($rsSlug > 0){
        $info = "1";
    }else{
        $options = ['cost' => 12];
        $mdpCript = password_hash($password,PASSWORD_BCRYPT,$options);
        $idUser = $admin->addCan($date,$nom,$prenom,$slug,$phone,$isoPhone,$dialPhone,$mdpCript,$role,$blq);
        if ($idUser > 0) {
            $info = "ok";
        }
    }


}
$output = array(
    'data_info' => $info
);
echo json_encode($output);
