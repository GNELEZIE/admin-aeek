<?php
session_start();
$data_list = '';
if(isset($_SESSION['useraeek']) and isset($_POST['eventId'])){
    extract($_POST);
//Include function
    include_once "../function/function.php";
    include_once "../function/domaine.php";
//Include Connexion
    include_once '../model/Connexion.class.php';

// appelle des class
    include_once '../model/Admin.class.php';
    include_once '../model/Gallerie.class.php';
    $eventId = htmlentities(trim(addslashes($eventId)));

    $liste = $gallerie->getGallerieById($eventId);

    while($data = $liste->fetch()) {
        if($data['photo'] != ''){
            $data_list .= '
                                        <div class="col-md-4 p-2">
                                            <a href="javascript:void(0)" class="mytrash"  title="Supprimer"><i class="fa fa-trash supicon" aria-hidden="true" onclick="supPhoto('.$data['id_gallerie'].')"></i>
                                            <img src="'.$domaine.'/uploads/'.$data['photo'].'" alt="Blog image" class="img-responsive gallerie-img">
                                            </a>
                                        </div>
            ';
        }
    }

}

$data_list .= '
       <div class="col-md-4">
                     <a href="javascript:void(0)" class="mytrash" onclick="ajoutPhoto()" title="Ajouter une photo">
                       <div class="w-100 text-center" style="background-color: #ff772917; padding-top: 26%; padding-bottom: 20%; height: 257px;">
                         <i class="mdi mdi-plus-circle-outline" style="font-size: 50px; color: #ff7729"></i>
                           </div>
                             </a>
                      </div>
        ';
$output = array(
    'fichierList' => $data_list
);
echo json_encode($output);