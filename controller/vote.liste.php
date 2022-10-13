<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){

    $listeVote= $voter->getAllVote();
    while($data = $listeVote->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_banniere'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_vote']),
            html_entity_decode(stripslashes($data['titre'])),
            html_entity_decode(stripslashes($data['sous_titre'])),
            $action


        );
    }
}

echo json_encode($arr_list);
