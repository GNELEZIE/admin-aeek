<?php
$getnbrevote ='';
if(isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){

    $nbre = $voter->getNbrVote()->fetch();
    $getnbrevote = $nbre['nb'];

}
$output = array(
    'getnbrevote' => $getnbrevote
);
echo json_encode($output);