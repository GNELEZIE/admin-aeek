<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){


    $listeCom= $comment->getAllComment();
    while($data = $listeCom->fetch()) {
        $nbs = $reponse->nbReponses($data['id_comment'])->fetch();


        $auth = '<a href="#" class="" style="color:inherit">'.html_entity_decode(stripslashes($data['nom'])).'<br> <small>'.html_entity_decode(stripslashes($data['email'])).'</small></a>';

        $des = '<a href="#" class="" style="color:inherit">'.reduit_text(html_entity_decode(stripslashes($data['message'])),'30').'</a>';

        $rsp = '<button type="button" class="btn bg-transparence-warning btn-sm d-block"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$nbs['nb'].'</font></font></button>';

         if($data['statut'] == 0){
             $status = '<span class="tag tag-radus bg-transparence-warning">En attente</span>';
             $action = '<div class="btn-list text-center">

                                      <a href="#modalReponse" id="bEdit" type="button" class="btn btn-sm btn-transparence-info" data-bs-toggle="modal" data-id="'.$data['id_comment'].'"  data-name="'. html_entity_decode(stripslashes($data['nom'])).'"  data-art_id="'. html_entity_decode(stripslashes($data['article_id'])).'" data-message="'. html_entity_decode(stripslashes($data['message'])).'" data-target="#modalReponse">
                                            <i class="icon icon-action-undo" data-bs-toggle="tooltip" title="" data-bs-original-title="icon-action-undo" aria-label="icon-action-undo"></i>
                                        </a>
                                       <a href="#modalUpdComment" id="bEdit" type="button" class="btn btn-sm btn-transparence-info" data-bs-toggle="modal" data-id="'.$data['id_comment'].'"  data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-message="'. html_entity_decode(stripslashes($data['message'])).'" data-target="#modalUpdComment">
                                            <span class="fe fe-eye"> </span>
                                        </a>


                                         <a href="#" id="bEdit" type="button" class="btn btn-sm btn-green-transparent" onclick="valider('.$data['id_comment'].')">
                                            <span class="fa fa-bell-o"> </span>
                                        </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_comment'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';
         }else{
             $status = '<span class="tag tag-radus btn-green-transparent">En ligne</span>';
             $action = '<div class="btn-list text-center">
                                       <a href="#modalReponse" id="bEdit" type="button" class="btn btn-sm btn-transparence-info" data-bs-toggle="modal" data-id="'.$data['id_comment'].'"  data-art_id="'. html_entity_decode(stripslashes($data['article_id'])).'" data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-message="'. html_entity_decode(stripslashes($data['message'])).'" data-target="#modalReponse">
                                            <i class="icon icon-action-undo" data-bs-toggle="tooltip" title="" data-bs-original-title="icon-action-undo" aria-label="icon-action-undo"></i>
                                        </a>
                                          <a href="#modalUpdComment" id="bEdit" type="button" class="btn btn-sm btn-transparence-info" data-bs-toggle="modal" data-id="'.$data['id_comment'].'"  data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-message="'. html_entity_decode(stripslashes($data['message'])).'" data-target="#modalUpdComment">
                                            <span class="fe fe-eye"> </span>
                                        </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_comment'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';
         }



        $arr_list['data'][] = array(
            date_fr($data['date_comment']),
            $auth,
            $des,
            $rsp,
            $status,
            $action
        );
    }
}

echo json_encode($arr_list);
