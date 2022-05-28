<?php
session_start();
$info = '';
//exit;
if(isset($_POST['email']) and isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['phone']) and isset($_POST['isoPhone']) and isset($_POST['dialPhone'])and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']) {
    extract($_POST);
// include function

    include_once "../function/domaine.php";
    include_once "../function/function.php";
    include_once "../function/mailing.php";

//Include Connexion
    include_once '../model/Connexion.class.php';
    include_once "../model/Admin.class.php";

    $email = htmlentities(trim(addslashes(strip_tags($email))));
    $nom = htmlentities(trim(addslashes(strip_tags($nom))));
    $prenom = htmlentities(trim(addslashes(strip_tags($prenom))));
    $phone = htmlentities(trim(addslashes(strip_tags($phone))));
    $isoPhone = htmlentities(trim(addslashes($isoPhone)));
    $dialPhone = htmlentities(trim(addslashes($dialPhone)));
    $date = date('Y-m-d H:i');
    error_reporting(E_ALL ^ E_NOTICE);
    $slug = create_slug($_POST['nom']);
    $propriete1 = 'nom';
    $verifSlug = $admin->verifUtilisateur($propriete1,$nom);
    $rsSlug = $verifSlug->fetch();
    $nbSlug =$verifSlug->rowCount();

    if($nbSlug > 0 AND $rsSlug['id_admin'] != $_SESSION['useraeek']['id_admin']){
        $slug = $slug.'-'.$nbSlug;
    }
//    $mailToken = str_replace('+','-',my_encrypt($email));
    $emailUser = 'email';
    $verifMail = $admin->verifUtilisateur($emailUser, $email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $info = 1;
    } elseif ($verifMail->rowCount() > 0) {
        $info = 2;
    } else {
        $idUser = $admin->addAdmin($date,$nom,$prenom,$slug,$email,$phone,$isoPhone,$dialPhone);
        if ($idUser > 0) {
            $info ="ok";
        }



}
}
$output = array(
    'data_info' => $info
);
echo json_encode($output);
