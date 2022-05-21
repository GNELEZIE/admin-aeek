<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
// include function

    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Tag.class.php";



    $listeTag= $tag->getAllTag();
    while($data = $listeTag->fetch()) {

      $action = '<div class="btn-list text-center">
                                        <a href="#modalUpdTag" id="bEdit" type="button" class="btn btn-sm btn-green-transparent" data-bs-toggle="modal" data-id="'.$data['id_tag'].'" data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-target="#modalUpdTag">
                                            <span class="fe fe-edit"> </span>
                                        </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_tag'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_tag']),
            $data['nom'],
            $action


        );
    }
}

echo json_encode($arr_list);
