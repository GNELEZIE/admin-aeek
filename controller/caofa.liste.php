<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){

    $liste = $sortie->getAllCaofa();
    while($data = $liste->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_caofa'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                        <a href="#modalCaofa"  class="btn btn-sm btn-green-transparent"  data-bs-toggle="modal" data-id="'.$data['id_caofa'].'" data-nom="'.html_entity_decode(stripslashes($data['nom'])).'" data-niveau="'.html_entity_decode(stripslashes($data['niveau'])).'" data-message="'.html_entity_decode(stripslashes($data['message'])).'"  data-target="#modalCaofa">
                                            <span class="fe fe-eye"> </span>
                                        </a>
                                    </div>';






        $arr_list['data'][] = array(
            date_fr($data['date_caofa']),
            html_entity_decode(stripslashes($data['nom'])),
            html_entity_decode(stripslashes($data['phone'])),
            html_entity_decode(stripslashes($data['niveau'])),
            $action


        );
    }
}

echo json_encode($arr_list);
