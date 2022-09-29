<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
// include function

    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Flash.class.php";



    $listeFlash = $flash->getAllFlash();
    while($data = $listeFlash->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_flash'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_flash']),
            date_fr($data['date_event']),
            html_entity_decode(stripslashes($data['titre'])),
            $action


        );
    }
}

echo json_encode($arr_list);
