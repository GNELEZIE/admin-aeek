<?php

if(isset($_SESSION['useraeek']) and isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email']) and isset($_POST['phone']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);
    $nom = htmlentities(trim(addslashes(strip_tags($nom))));
    $prenom = htmlentities(trim(addslashes(strip_tags($prenom))));
    $phone = htmlentities(trim(addslashes(strip_tags($phone))));
    $isoPhone = htmlentities(trim(addslashes(strip_tags($isoPhone))));
    $dialPhone = htmlentities(trim(addslashes(strip_tags($dialPhone))));
    $email = htmlentities(trim(addslashes(strip_tags($email))));
    $fonction = htmlentities(trim(addslashes(strip_tags($fonction))));
    $niveau = htmlentities(trim(addslashes(strip_tags($niveau))));
    $biographie = htmlentities(trim(addslashes(strip_tags($biographie))));
    $facebook = htmlentities(trim(addslashes(strip_tags($facebook))));
    $twitter = htmlentities(trim(addslashes(strip_tags($twitter))));
    $linkedin = htmlentities(trim(addslashes(strip_tags($linkedin))));
    $instagram = htmlentities(trim(addslashes(strip_tags($instagram))));

    $slug = create_slug($_POST['nom']);
    $propriete1 = 'nom';
    $verifSlug = $admin->verifUtilisateur($propriete1,$nom);
    $rsSlug = $verifSlug->fetch();
    $nbSlug =$verifSlug->rowCount();

    $verifEmail = $admin->getAdminByEmail($email);
    $rsEmail = $verifEmail->fetch();
    $propriete2 = 'prenom';
    $propriete3 = 'email ';
    $propriete4 = 'phone';
    $propriete5 = 'iso_phone';
    $propriete6 = 'dial_phone';
    $propriete7 = 'slug';
    $propriete8 = 'fonction';
    $propriete9 = 'niveau';
    $propriete10 = 'biographie';
    $propriete11 = 'facebook';
    $propriete12 = 'twitter';
    $propriete13 = 'linkedin';
    $propriete14 = 'instagram';
    if($nbSlug > 0 AND $rsSlug['id_admin'] != $_SESSION['useraeek']['id_admin']){
        $slug = $slug.'-'.$nbSlug;
    }


    if($email != '' AND !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['upd'] = 'Votre adresse email n\'est pas correct';
    }else if($_SESSION['useraeek']['email'] ==$email){
        $update = $admin->updateData14($propriete1,$nom,$propriete2,$prenom,$propriete3,$email,$propriete4,$phone,$propriete5,$isoPhone,$propriete6,$dialPhone,$propriete7,$slug,$propriete8,$fonction,$propriete9,$niveau,$propriete10,$biographie,$propriete11,$facebook,$propriete12,$twitter,$propriete13,$linkedin,$propriete14,$instagram,$_SESSION['useraeek']['id_admin']);
        if($update > 0){
            $success['upd'] = 'Votre profil à été mis à jour avec succès';
        }
    }else if($verifEmail->rowCount() > 0 and $rsEmail['email'] != $_SESSION['useraeek']['email']){
        $errors['upd'] = 'Votre adresse email existe déjà !';
    }
    else{
        $update = $admin->updateData13($propriete1,$nom,$propriete2,$prenom,$propriete4,$phone,$propriete5,$isoPhone,$propriete6,$dialPhone,$propriete7,$slug,$propriete8,$fonction,$propriete9,$niveau,$propriete10,$biographie,$propriete11,$facebook,$propriete12,$twitter,$propriete13,$linkedin,$propriete14,$instagram,$_SESSION['useraeek']['id_admin']);
        $mailToken = str_replace('+','-',my_encrypt($_SESSION['useraeek']['email']));
        $subject = trim('Modification de votre email');
        $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;  font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="icon" href="'.$domaine_admin.'/media/img/logo.png" type="image/x-icon">
    <title>Africa Wide Help</title>


    <style type="text/css">
        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box; font-size: 14px;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6em;
            background-color: #f6f6f6;
            margin: 0;
        }

        .body-wrap{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            width: 100%;
            background-color: #f6f6f6;
            margin: 0;
        }


        tr{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            margin: 0;
        }


        td{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            vertical-align: top;
            margin: 0;
        }



        td.container{
            width:600px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            vertical-align: top;
            display: block !important;
            max-width: 600px !important;
            clear: both !important;
            margin: 0 auto;

        }


        div.content{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px; max-width: 600px;
            display: block;
            margin: 0 auto;
            padding: 20px;
        }

        table.main{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 3px;
            margin: 0; border: none;
        }

        td.content-wrap{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            vertical-align: top;
            margin: 0;padding: 30px;
            border: 3px solid #55b4a85c;
            display: inline-block;
            border-radius: 7px;
            background-color: #fff;

        }

        meta.mymeta{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            margin: 0;
        }

        td a{
            display: block;
            margin-bottom: 10px;
        }

        td.content-block{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            vertical-align: top;
            margin: 0;
            padding: 0 0 20px;


        }

        .td-logo{
            text-align: center;
        }

        td.content-block a.btn-primary{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            color: #FFF;
            text-decoration: none;
            line-height: 2em;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            background-color: #55b4a8;
            margin: 0;
            border-color: #55b4a8;
            border-style: solid;
            border-width: 8px 16px;
        }


        div.desabonne{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            width: 100%;
            clear: both;
            color: #999;
            margin: 0;

        }



        td.aligncenter{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 12px;
            vertical-align: top;
            color: #999;
            text-align: center;
            margin: 0;
            padding: 0 0 20px;
        }


        a.desabon{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            box-sizing: border-box;
            font-size: 12px;
            color: #999;
            text-decoration: underline;
            margin: 0;

        }
    </style>
</head>

<body>

<table class="body-wrap">
    <tr>
        <td valign="top"></td>
        <td class="container" valign="top">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="https://schema.org/ConfirmAction">
                    <tr>
                        <td class="content-wrap" valign="top">
                            <meta itemprop="name" content="Confirm Email"  class="mymeta">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="td-logo">
                                        <a href="'.$domaine_admin.'"><img src="'.$domaine_admin.'/media/img/logo.png" height="100" alt="logo"/></a> <br/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" valign="top">
                                        <p>Veuillez confirmer votre adresse e-mail en cliquant sur le lien ci-dessous.</p>
                                        <p>Nous pouvons avoir besoin de vous envoyer des informations critiques sur notre service et il est important que nous ayons une adresse e-mail valide.</p>
                                    </td>
                                </tr>
                                <tr style="text-align:center">
                                    <td class="content-block" itemprop="handler" itemscope itemtype="https://schema.org/HttpActionHandler" valign="top">
                                        <a href="'.$domaine_admin.'/valid-update-email/?token='.$mailToken.'" class="btn-primary" itemprop="url">Confirmer mon email</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" valign="top">
                                        Après avoir valider votre email,vous pourriez acceder facilement à votre compte. Nous vous souhaitons une très bonne expérience.
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">Cordialement, <br/>Africa Wide help</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td valign="top"></td>
    </tr>
</table>
<div class="desabonne pt-0">
    <table width="100%">
        <tr>
            <td class="aligncenter content-block" align="center" valign="top">
                Merci de ne passe répondre à cet email. Pour nous contacter, cliquez sur <a href="'.$domaine_admin .'" class="desabon">Aide et contact</a><br/>
                Copyright © 2021 Africa Wide Help. Tous droits réservés.
            </td>
        </tr>
    </table>
</div>
</body>
</html>
';
        sendMailNoReply($email,$subject,$message);

        $tab = array(
            "id" => $_SESSION['useraeek']['id_admin'],
            "email" => $email,
        );
        $_SESSION['_valid'] = $tab;
        header('location:' .$domaine_admin.'/update-email-no-valid');
        exit();
    }


}