<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
// include function

    include_once "../function/function.php";
    include_once "../function/domaine.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Emplois.class.php";


    $res = $emplois->getAllEmplois();

    while($data = $res->fetch()) {
        if($data['type_offre'] == 1){
            $contract = 'PAE';
        }elseif($data['type_offre'] == 2){
            $contract = 'CDD';
        }elseif($data['type_offre'] == 3){
            $contract = 'CDI';
        }elseif($data['type_offre'] == 4){
            $contract = 'Stage école';
        }elseif($data['type_offre'] == 5){
            $contract = 'CTT';
        }else{
            $contract = 'Frulence';
        }
        if($data['statut'] == 1){
            $valid = '<a href="javascript:void(0);" id="" type="button" class="btn  btn-sm btn-green-transparent" onclick="debloquer('.$data['id_emplois'].')"> <span class="fe fe-bell-off"> </span> </a>';
            $status = '<span class="tag tag-radus bg-transparence-warning">Hors ligne</span>';
        }else{
            $status = '<span class="tag tag-radus btn-green-transparent">Active</span>';
            $valid = '<a href="javascript:void(0);" id="" type="button" class="btn  btn-sm btn-green-transparent" onclick="bloquer('.$data['id_emplois'].')"> <span class="fe fe-bell"> </span> </a>';

        }
        $contrat = '<span class="btn btn-sm btn-transparence-info">'.$contract.'</span>';
       $fin = '<span class="btn  btn-sm btn-red-transparent">'. date_fr($data['date_fin']).'</span>';
        $action = '<div class="btn-list text-center">
                        '.$valid.'
                         <a href="'.$domaine.'/emplois" class="btn btn-sm btn-transparence-info"> <i class="fe fe-eye"></i> </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_emplois'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_emplois']),
            reduit_text(html_entity_decode(stripslashes($data['nom'])),'50'),
            $fin,
            $contrat,
            $status,
            $action


        );
    }
}

echo json_encode($arr_list);
