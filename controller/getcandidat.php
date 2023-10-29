<?php
$getcandidat ='';
if(isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){

    $nbre = $candidat->getNbCandidat()->fetch();
    $getcandidat = $nbre['nb'];

}
$output = array(
    'getcandidat' => $getcandidat
);
echo json_encode($output);