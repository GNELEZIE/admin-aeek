<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek'])){
// include function
    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class

    include_once "../model/Admin.class.php";

    $liste = $admin->getAllAdmin();

    while($data = $liste->fetch()) {
        if($data['bloquer'] == 0){
            $status = '<span class="tag tag-radus bg-transparence-warning">En attente</span>';
            $bloquer = '<a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-transparence-info" onclick="bloquer('.$data['id_admin'].')">
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        </a>';

        }elseif($data['bloquer'] == 2 ){
            $status = ' <span class="tag tag-radus btn-red-transparent">Bloqué</span>';
            $bloquer = '<a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-transparence-orange" onclick="debloquer('.$data['id_admin'].')" style="padding: 3px 11px !important;">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </a>';
        }else{
            $status = '<span class="tag tag-radus btn-green-transparent">Active</span>';
            $bloquer = '<a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-transparence-info" onclick="bloquer('.$data['id_admin'].')"  style="padding: 3px 11px !important;">
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        </a>';

        }

        $nom = '<div class="user-info"> <span class="tb-lead">'.html_entity_decode(htmlentities($data["nom"])).'<span class="dot dot-warning d-md-none ml-1"></span>';
        $action = '<div class="btn-list text-center">
                                        <a href="#modalUpdCat" id="bEdit" type="button" class="btn btn-sm btn-green-transparent" data-bs-toggle="modal" data-id="'.$data['id_admin'].'" data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-target="#modalUpdCat">
                                            <span class="fe fe-edit"> </span>
                                        </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_admin'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                        '.$bloquer.'
                                    </div>';

        $role = 1;
        $arr_list['data'][] = array(
            date_fr($data['date_admin']),
            $nom,
            $data['dial_phone'].' '.$data['phone'],
            $data['email'],
            $role,
            $status,
           $action
        );
    }
}

echo json_encode($arr_list);
