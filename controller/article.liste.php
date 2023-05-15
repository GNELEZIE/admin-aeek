<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){


    $listeArticle= $article->getAllArticle();
    while($data = $listeArticle->fetch()) {
        $cat = $categorie->getCategorieById($data['categorie_id'])->fetch();
        if($data['statut'] == 0){
            $statut ='<span class="tag tag-radus tag-round tag-outline-success">En ligne</span>';
            $upd ='<a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-green-transparent" onclick="bloquer('.$data['id_article'].')">
                                            <span class="fa fa-bell-o"> </span>
                                        </a>
                                        <a href="'.$domaine_admin.'/blog/'.$data['slug'].'" id="bEdit"  class="btn btn-sm bg-transparence-warning">
                                            <span class="fe fe-edit"> </span>
                                        </a>';

        }else{
            $statut ='<span class="tag tag-radus tag-round tag-outline-danger">Hors ligne</span>';
            $upd ='<a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-green-transparent" onclick="valider('.$data['id_article'].')">
                                            <span class="fa fa-bell-slash-o"> </span>
                                        </a>
                                          <a href="'.$domaine_admin.'/blog/'.$data['slug'].'" id="bEdit"  class="btn btn-sm bg-transparence-warning">
                                            <span class="fe fe-edit"> </span>
                                        </a>';


        }
        $action = '<div class="btn-list text-center">
'.$upd.'
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_article'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                          <a href="'.$domaine.'/show/'.$data['slug'].'" id="bDel" class="btn  btn-sm btn-transparence-info" target="_blank">
                                            <span class="fe fe-eye"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_article']),
            html_entity_decode(stripslashes($cat['nom'])),
            $statut,
            $action


        );
    }
}

echo json_encode($arr_list);
