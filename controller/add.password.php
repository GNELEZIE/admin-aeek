<?php
if(isset($_POST['idAdmin']) and isset($_POST['adm']) and isset($_POST['password']) and isset($_POST['cpassword']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $password = htmlentities(trim(addslashes($password)));
    $cpassword = htmlentities(trim(addslashes($cpassword)));
    $idAdmin = htmlentities(trim(addslashes($idAdmin)));
    $adm = htmlentities(trim(addslashes($adm)));
    $valid_mail = 1;

    $result = $admin->getAdminById($idAdmin);
    if($data = $result->fetch()){
        if(strlen($_POST['password']) < 8){
            $errors['connect'] = 'Le mot de passe est trop court, il doit faire 8 caractères minimum';
        }elseif($data['email'] == $adm){
            if($password == $cpassword){
                $options = ['cost' => 12];
                $mdpCript = password_hash($password,PASSWORD_BCRYPT,$options);
                $update = $admin->newPassword($mdpCript,$valid_mail,$idAdmin);
                if($update > 0){
                    $success['message'] = 'Mot de passe modifier avec succès <br> <a href="'.$domaine_admin.'/login">Cliquer ici pour vous connecter</a>';
                }
            }else{
                $errors['connect'] = 'Erreur de confirmation du mot de passe';
            }
        }else{
            $errors['connect'] = 'Une erreur s\'est produite lors de l\'activation du compte';
        }
    }else{
        $errors['connect'] = 'Une erreur s\'est produite lors de l\'activation du compte';
    }
}