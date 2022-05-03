<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
// include function

    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Categorie.class.php";



    $listeCat= $categorie->getAllCategorie();
    while($data = $listeCat->fetch()) {

      $action = '<div class="btn-list text-center">
                                        <a href="#modalUpdCat" id="bEdit" type="button" class="btn btn-sm btn-green-transparent" data-bs-toggle="modal" data-id="'.$data['id_categorie'].'" data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-target="#modalUpdCat">
                                            <span class="fe fe-edit"> </span>
                                        </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_categorie'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_categorie']),
            $data['nom'],
            $action


        );
    }
}

echo json_encode($arr_list);
