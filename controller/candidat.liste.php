<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){

    $listeCand= $candidat->getAllCandidat();
    $rang = 0;
    while($data = $listeCand->fetch()) {
        $rang ++;
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_candidat'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                        <a href="'.$domaine_admin.'/edit-candidat/'.$data['slug'].'" id="bDel" type="button" class="btn  btn-sm btn-info-transparent" >
                                            <span class="fe fe-edit-2"> </span>
                                        </a>
                                    </div>';

        $pho =  '<img src="'.$domaine.'/uploads/'.$data['photo'].'" class="img-cand">';
        $voix =  '<a  id="bDel" type="button" class="btn  btn-sm btn-green-transparent">
                                         '.$data['nbvote'].'
                                        </a>';

        $nom = html_entity_decode(stripslashes($data['nom'])).' '.html_entity_decode(stripslashes($data['prenom']));

        $arr_list['data'][] = array(
            $rang,
            $pho,
            $nom,
            html_entity_decode(stripslashes($data['fonction'])),
            $voix,
            $action


        );
    }
}

echo json_encode($arr_list);
