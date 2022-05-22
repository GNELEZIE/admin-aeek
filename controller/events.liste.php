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
    include_once "../model/Events.class.php";



    $listeEven= $events->getAllEvents();
    while($data = $listeEven->fetch()) {
        $nbs = '<a href="" class="bg-transparence-warning" style="padding: 6px;">25</a>';
        $action = '<div class="btn-list text-center">
                                         <a href="'.$domaine_admin.'/gallerie/'.$data['slug'].'" class="btn btn-sm btn-transparence-info"> <i class="fe fe-eye"></i> </a>

                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_events'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>

            ';

        $arr_list['data'][] = array(
            date_fr($data['created_date']),
            date_fr($data['date_events']),
            reduit_text(html_entity_decode(stripslashes($data['nom'])),'40'),

            $nbs,
            $action


        );
    }
}

echo json_encode($arr_list);
