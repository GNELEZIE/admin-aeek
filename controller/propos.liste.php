<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
// include function
    include_once "../function/domaine.php";
    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Propos.class.php";



    $listePop= $propos->getAllpropos();
    while($data = $listePop->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_propos'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                        <a href="#modalUpdPropos" id="bEdit" type="button" class="btn btn-sm btn-transparence-info" data-bs-toggle="modal" data-id="'.$data['id_propos'].'"  data-name="'. html_entity_decode(stripslashes($data['titre'])).'" data-sous="'. html_entity_decode(stripslashes($data['sous_titre'])).'" data-description ="'. html_entity_decode(stripslashes($data['description'])).'" data-image ="'.$domaine.'/uploads/'.html_entity_decode(stripslashes($data['photo'])).'" data-target="#modalUpdPropos">
                                            <span class="fe fe-eye"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_propos']),
            reduit_text(html_entity_decode(stripslashes($data['titre'])),'40'),
            reduit_text(html_entity_decode(stripslashes($data['sous_titre'])),'40'),
            $action
        );
    }
}

echo json_encode($arr_list);
