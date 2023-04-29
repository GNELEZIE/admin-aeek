<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek'])){
// include function
    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class

    include_once "../model/User.class.php";

    $liste = $user->getAllUserReunion();

    while($data = $liste->fetch()) {


        $nom = '<div class="user-info"> <span class="tb-lead">'.html_entity_decode(htmlentities($data["nom"])).'<span class="dot dot-warning d-md-none ml-1"></span>';
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn btn-red-transparent" onclick="supprimer('.$data['id_reunion'].')" style="padding: 3px 9px !important;">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>

                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_membre']),
            $nom,
            $data['dial_phone'].' '.$data['phone'],
            html_entity_decode(htmlentities($data["ville"])),
            $data['email'],
           $action
        );
    }
}

echo json_encode($arr_list);
