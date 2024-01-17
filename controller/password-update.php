<?php
if(isset($_SESSION['useraeek']) and isset($_POST['password']) and isset($_POST['a_passsword'])  and isset($_POST['c_password']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $password = htmlentities(trim(addslashes($password)));
    $c_password = htmlentities(trim(addslashes($c_password)));
    $a_passsword = htmlentities(trim(addslashes($a_passsword)));

    $result = $admin->getAdminById($_SESSION['useraeek']['id_admin']);
    if(strlen($_POST['password']) >= 8){
        if($password == $c_password){
            if($data = $result->fetch()){
                if(password_verify($a_passsword,$data['mot_de_passe'])){
                    $options = ['cost' => 12];
                    $mdpCript = password_hash($password,PASSWORD_BCRYPT,$options);
                    $update = $admin->updatePassword($mdpCript,$_SESSION['useraeek']['id_admin']);
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
}