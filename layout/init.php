<?php
ini_set("session.cookie_httponly", True);
session_start();

// include function
include_once "function/domaine.php";
include_once "function/mailing.php";
include_once "function/function.php";



//Include Connexion
include_once 'model/Connexion.class.php';

// appelle des class
include_once 'model/Admin.class.php';





 if(isset($_COOKIE['aeekcookie']) AND !isset($_SESSION['useraeek'])){
    $email = my_decrypt($_COOKIE['useraeek']);
    $result = $admin->getAdminByEmail($email);
    if($data = $result->fetch()){
        if($data['bloquer'] == 0){
            $_SESSION['useraeek'] = $data;
        }else{
            setcookie('aeekcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
        }
    }else{
        setcookie('aeekcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
    }
 }

 if(isset($_SESSION['useraeek'])){
     $result = $admin->getAdminById($_SESSION['useraeek']['id_admin']);
     if($data = $result->fetch()){
         if($data['bloquer'] != 0){
             if(isset($_COOKIE['ecoldecroshi'])) {
                 setcookie('ecoldecroshi',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
             }
             unset($_SESSION['useraeek']);
         }
     }else{
         unset($_SESSION['useraeek']);
     }
 }
