<?php
if(isset($_POST['dialPhone']) and isset($_POST['phone']) and isset($_POST['password']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);
    $phone = htmlentities(trim(addslashes(strip_tags($phone))));
    $dialPhone = htmlentities(trim(addslashes(strip_tags($dialPhone))));
    $password = htmlentities(trim(addslashes($password)));
    $lgphone = $dialPhone .''.$dialPhone;
    if(is_numeric($lgphone)){
        if($password != ''){
            $result = $admin->getAdminByPhone($phone,$dialPhone);
            if($data = $result->fetch()){
                if ($data['bloquer'] == 1) {
                    if (password_verify($password, $data['mot_de_passe'])) {
                        $_SESSION['useraeek'] = $data;
                        $myphone = $dialPhone .'-'.$dialPhone;
                        $user = my_encrypt($myphone);
                        setcookie('aeekcookie', $user, time() + 60 * 60 * 24 * 30, '/', $cookies_domaine, true, true);
                        if(isset($_GET['return'])){
                            header('location:' . $_GET['return']);
                        }else{
                            header('location:' . $domaine_admin);
                        }
                        exit();
                    } else {
                        $errors['connect'] = 'Username ou mot de passe incorrect';
                    }
                } else {
                    $errors['connect'] = 'Votre compte a été bloqué';
                }

            }else{
                $errors['connect'] = 'Username ou mot de passe incorrect';
            }

        }else{
            $errors['connect'] = 'Username ou mot de passe incorrect';
        }
    }else{
        $errors['connect'] = 'Username ou mot de passe incorrect';
    }

}