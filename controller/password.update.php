<?php
if(isset($_POST['idAdmin']) and isset($_POST['adm']) and isset($_POST['password']) and isset($_POST['cpassword']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $password = htmlentities(trim(addslashes($password)));
    $cpassword = htmlentities(trim(addslashes($cpassword)));
    $idAdmin = htmlentities(trim(addslashes($idAdmin)));
    $adm = htmlentities(trim(addslashes($adm)));

    $result = $admin->getAdminById($idAdmin);
    if($data = $result->fetch()){
        if($data['email'] == $adm){
            if($password == $cpassword){
                $options = ['cost' => 12];
                $mdpCript = password_hash($password,PASSWORD_BCRYPT,$options);
                $update = $admin->updatePassword($mdpCript,$idAdmin);
                if($update > 0){
                    $success['message'] = 'Votre mot de passe a été modifié avec succès !<br> <a href="'.$domaine_admin.'/login">Cliquer ici pour vous connecter</a>';
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