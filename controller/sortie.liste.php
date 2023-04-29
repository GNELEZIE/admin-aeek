<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){

    $liste = $sortie->getAllInscript();
     $nb = 1;
    while($data = $liste->fetch()) {
        $nbs = $nb++;
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_sortie'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        if($data['membre'] == 'Oui'){
            $mbre =  '<a  id="bDel" type="button" class="btn  btn-sm btn-info-transparent">'.$data['membre'].'</a>';
        }else{
            $mbre =  '<a  id="bDel" type="button" class="btn  btn-sm btn-red-transparent">'.$data['membre'].'</a>';
        }





        $arr_list['data'][] = array(
            $nbs,
            date_time_fr($data['date_sortie']),
            html_entity_decode(stripslashes($data['nom'])),
            html_entity_decode(stripslashes($data['phone'])),
            $mbre,
            $action


        );
    }
}

echo json_encode($arr_list);
