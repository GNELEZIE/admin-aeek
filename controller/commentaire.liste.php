<?php
session_start();
$arr_list = array('data' => array());
if(isset($_SESSION['useraeek']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
// include function

    include_once "../function/function.php";

//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once "../model/Article.class.php";
    include_once "../model/Categorie.class.php";
    include_once "../model/Comment.class.php";



    $listeCom= $comment->getAllComment();
    while($data = $listeCom->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="#modalUpdCat" id="bEdit" type="button" class="btn btn-sm btn-green-transparent" data-bs-toggle="modal" data-id="'.$data['id_comment'].'" data-name="'. html_entity_decode(stripslashes($data['nom'])).'" data-target="#modalUpdCat">
                                            <span class="fe fe-edit"> </span>
                                        </a>
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_comment'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $arr_list['data'][] = array(
            date_fr($data['date_comment']),
            reduit_text(html_entity_decode(stripslashes($data['message'])),'70'),
            html_entity_decode(stripslashes($data['nom'])),
            $action


        );
    }
}

echo json_encode($arr_list);
