<?php

$date = date('Y-m-d H:i');
$propriete1 = 'phone';
$propriete2 = 'nom';


$ve = $sortie->getAllCan();

while($dat = $ve->fetch()){
    $verifSlug = $admin->verifUtilisateur($propriete2,$dat['nom']);
    $nbSlug = $verifSlug->rowCount();


    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }else{
        $slug = create_slug($dat['nom']);
    }
    $verif = $admin->verifUtilisateur($propriete1,$dat['phone']);
    if($verif->fetch()){

    }else{
        $password = 'AEKK@2024';
        $options = ['cost' => 12];
        $mdpCript = password_hash($password,PASSWORD_BCRYPT,$options);
        $idUser = $admin->addCan($date,$dat['nom'],$dat['prenom'],$slug,$dat['phone'],'ci',225,$mdpCript,4,1);
    }



}

