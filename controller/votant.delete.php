<?php
if(isset($_SESSION['useraeek']) and isset($_POST['id'])){

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $cand = $voter->getCandidatByVotantId($id)->fetch();

    $val = $cand['nbvote'] - 1;
    $nbv = $candidat->updateVote2($val,$cand['id_candidat']);
    $delete = $voter->deleteVotant($id);

    echo 'ok';

}