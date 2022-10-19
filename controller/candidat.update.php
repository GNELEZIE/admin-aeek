<?php

if(isset($_SESSION['useraeek']) and isset($_POST['nom']) and isset($_POST['prenom']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);
    $nom = htmlentities(trim(addslashes(strip_tags($nom))));
    $prenom = htmlentities(trim(addslashes(strip_tags($prenom))));
    $fonction = htmlentities(trim(addslashes(strip_tags($fonction))));
    $bio = htmlentities(trim(addslashes(strip_tags($bio))));
    $cand = htmlentities(trim(addslashes(strip_tags($cand))));


    $propriete1 = 'nom';
    $propriete2 = 'prenom';
    $propriete3 = 'fonction ';
    $propriete4 = 'bio';
    $candId = $candidat->getCandidatById($cand);
    if($candId->rowCount() > 0){
        $update = $candidat->candidatUpdate($propriete1,$nom,$propriete2,$prenom,$propriete3,$fonction,$propriete4,$bio,$cand);
        if($update > 0){
            $success['upd'] = 'Le candidat à été mis à jour avec succès';
        }
    }else{
        $errors['upd'] = "Une erreur s'est produite lors de la modification !";
    }
}