<?php
if(isset($_SESSION['adminafricahelp']) and isset($_POST['password']) and isset($_POST['npassword']) and isset($_POST['cnpassword']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);
    $password = htmlentities(trim(addslashes($password)));
    $npassword = htmlentities(trim(addslashes($npassword)));
    $cnpassword = htmlentities(trim(addslashes($cnpassword)));
    $longueur = strlen($npassword);
 if($longueur >= 8){
     if($npassword == $cnpassword){
         $result = $admin->getAdminById($_SESSION['adminafricahelp']['id_admin']);
         if($data = $result->fetch()){
             if(password_verify($password,$data['mot_de_passe'])){
                 $options = ['cost' => 12];
                 $mdpCript = password_hash($npassword,PASSWORD_BCRYPT,$options);
                 $update = $admin->updatePassword($mdpCript,$_SESSION['adminafricahelp']['id_admin']);
                 if($update >0){
                     $success['success'] = 'Votre mot de passe a été modifié avec succès';
                 }
             }else{
                 $errors['connect'] = 'L\'ancien mot de passe n\'est pas correct';
             }
         }else{
             $errors['connect'] = 'Une erreur s\'est produite lors du traitement des données';
         }
     }else{
         $errors['connect'] = 'Le mot de passe ne correspond pas';
     }
 }else{
     $errors['connect'] = 'Le mot de passe est trop court, il doit faire 8 caractères minimum';
 }
}elseif(!isset($_POST)){
    $errors['connect'] = 'Une erreur s\'est produite lors du traitement des données !';
}