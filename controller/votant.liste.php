<?php

$arr_list = array('data' => array());


    $listeVotant = $voter->getAllVotants();
    $rang = 0;
    while($data = $listeVotant->fetch()) {
        $rang ++;
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_voter'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';



        $prenom = '<span class="badge-green">'. html_entity_decode(stripslashes($data['prenom'])).'</span>';

        $arr_list['data'][] = array(
            date_fr($data['date_vote']),
            html_entity_decode(stripslashes($data['ip'])),
            html_entity_decode(stripslashes($data['nom_votant'])),
            $data['dial_votant'].' '.$data['phone_votant'],
            $prenom,
            $action


        );
    }


echo json_encode($arr_list);
