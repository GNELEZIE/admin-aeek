<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeek'])){
    header('location:'.$domaine_admin.'/login');
    exit();
}




$allVis = $compter->getAllVus();

if($visAll = $allVis->fetch()){
    $visit = $compter->nbVisiteurs()->fetch();
    $nVus = $compter->SommeVus()->fetch();
    $nbVusChrome = $compter->nbByBrowser('Chrome')->fetch();
    $nbVusFiref = $compter->nbByBrowser('Firefox')->fetch();
    $nbVusExplorer = $compter->nbByBrowser('Explorer')->fetch();
    $nbVusEdg = $compter->nbByBrowser('Edg')->fetch();
    $nbVusSafari = $compter->nbByBrowser('Safari')->fetch();
    $nbVusOpera= $compter->nbByBrowser('opera')->fetch();
    $nbMobile= $compter->nbByDevices('mobile')->fetch();
    $nbDest= $compter->nbByDevices('pc')->fetch();
    $nbVisiteurs = $visit['nb'];
    $nbVu = $nVus['nb'];
    $nbPc = pourcentage($nbVu,$nbDest['sm']);
    $mobil = pourcentage($nbVu,$nbMobile['sm']);
    $chrome = pourcentage($nbVu,$nbVusChrome['sm']);
    $Firefox = pourcentage($nbVu,$nbVusFiref['sm']);
    $Explorer = pourcentage($nbVu,$nbVusExplorer['sm']);
    $Edg = pourcentage($nbVu,$nbVusEdg['sm']);
    $Safari = pourcentage($nbVu,$nbVusSafari['sm']);
    $Opera = pourcentage($nbVu,$nbVusOpera['sm']);

}else{
    $nbPc =0;
    $mobil =0;
    $nbVisiteurs =0;
    $nbVu = 0;
    $chrome = '0%';
    $Firefox ='0%';
    $Explorer = '0%';
    $Edg ='0%';
    $Safari ='0%';
    $Opera = '0%';
}






$list = $article->getAllArticle();
if($dts = $list->fetch()){
    $nbs = $article->getAllNbrArticle()->fetch();
    $nbArticle = $nbs['nb'];
}else{
    $nbArticle = 0;
}

$rs = $comment->getAllComment();
$rsEnAt = $comment->getAllCommentEnAttente();
$rsValid = $comment->getAllCommentValider();
$rsr = $reponse->getAllReponses();

if($resl = $rs->fetch()){
    $comNb = $comment->nbComments()->fetch();
    $nbsComt =  $comNb['nb'];
}else{
    $nbsComt = 0;
}


if($reslr = $rsr->fetch()){
    $rpNb = $reponse->nbRepon()->fetch();
    $nbsR =  $rpNb['nb'];
}else{
    $nbsR = 0;
}

$Emploi_dt= $emplois->getAllEmploisActive();

if($reslr = $Emploi_dt->fetch()){
    $nbEmploi= $emplois->nbEmplois()->fetch();
    $emploiNb = $nbEmploi['nb'];
}else{
    $emploiNb = 0;
}


$nbTotComment = $nbsComt + $nbsR;
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php'
?>
<!--app-content open-->
<div class="main-content app-content mt-0">
<div class="side-app">

<div class="main-container container-fluid">
<div class="row pt-5 mt-5">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-primary img-card box-primary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font"><?=$nbVisiteurs?></h2>
                                <p class="text-white mb-0">Visiteurs</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-secondary img-card box-secondary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font"><?=$nbVu?></h2>
                                <p class="text-white mb-0">Vus</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-eye text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card  bg-success img-card box-success-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font"><?=$emploiNb?></h2>
                                <p class="text-white mb-0">Offres d'emplois</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-briefcase text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-info img-card box-info-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font"><?=$nbArticle?></h2>
                                <p class="text-white mb-0">Articles</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-xl-6 col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title fw-semibold">Commentaire en attente</h4>
        </div>
        <div class="card-body pb-0" id="here">
            <ul class="task-list">
                <?php
                $com = $comment->getAllCommentCinq();
                while($comments = $com->fetch()){
                    ?>

                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-warning"></i>
                            <h6 class="fw-semibold"><?=$comments['nom']?><span
                                    class="text-muted fs-11 mx-2 fw-normal"><?=date_lettre($comments['date_comment'])?></span>
                            </h6>
                            <p class="text-muted fs-12"><?=reduit_text(html_entity_decode(stripslashes($comments['message'])),'40')?> <a
                                    href="#" class="fw-semibold"> Voir l'article</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">

                            <a href="#modalUpdComment" id="bEdit" type="button"  data-bs-toggle="modal" data-id="<?=$comments['id_comment']?>"  data-name="<?=$comments['nom']?>" data-message="<?=$comments['message']?>" data-target="#modalUpdComment">
                                <span class="fe fe-edit"> </span>
                            </a>

                            <a href="javascript:void(0)"  onclick="supprimer(<?=$comments['id_comment']?>)" class="text-muted text-red"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                <?php
                }
                ?>


            </ul>
        </div>
    </div>
</div>


<div class="col-xl-6 col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title fw-semibold">Navigateur</h4>
        </div>
        <div class="card-body">
            <div class="browser-stats">
                <div class="row mb-4">
                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                        <img src="<?=$asset?>/images/browsers/chrome.svg" class="img-fluid"
                             alt="img">
                    </div>
                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between mb-1">
                            <h6 class="mb-1">Chrome</h6>
                            <h6 class="fw-semibold mb-1"><?=$chrome?>%<span
                                    class="text-success fs-11">(<i
                                        class="fe fe-arrow-up"></i>12.75%)</span></h6>
                        </div>
                        <div class="progress h-2 mb-3">
                            <div class="progress-bar bg-primary" style="width: <?=floor($chrome)?>%;" role="progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                        <img src="<?=$asset?>/images/browsers/opera.svg" class="img-fluid"
                             alt="img">
                    </div>
                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between mb-1">
                            <h6 class="mb-1">Opera</h6>
                            <h6 class="fw-semibold mb-1"><?=$Opera?>% <span
                                    class="text-danger fs-11">(<i
                                        class="fe fe-arrow-down"></i>15.12%)</span></h6>
                        </div>
                        <div class="progress h-2 mb-3">
                            <div class="progress-bar bg-secondary" style="width: <?=floor($Opera)?>%;"
                                 role="progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                        <img src="<?=$asset?>/images/browsers/ie.svg" class="img-fluid"
                             alt="img">
                    </div>
                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between mb-1">
                            <h6 class="mb-1">IE</h6>
                            <h6 class="fw-semibold mb-1"><?=$Explorer?>%<span
                                    class="text-success fs-11">(<i
                                        class="fe fe-arrow-down"></i>24.37%)</span></h6>
                        </div>
                        <div class="progress h-2 mb-3">
                            <div class="progress-bar bg-success" style="width: <?=floor($Explorer)?>%;"
                                 role="progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                        <img src="<?=$asset?>/images/browsers/firefox.svg" class="img-fluid"
                             alt="img">
                    </div>
                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between mb-1">
                            <h6 class="mb-1">Firefox</h6>
                            <h6 class="fw-semibold mb-1"><?=$Firefox?>%<span
                                    class="text-success fs-11">(<i
                                        class="fe fe-arrow-down"></i>15.63%)</span></h6>
                        </div>
                        <div class="progress h-2 mb-3">
                            <div class="progress-bar bg-danger" style="width: <?=floor($Firefox)?>%;"
                                 role="progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                        <img src="<?=$asset?>/images/browsers/edge.svg" class="img-fluid"
                             alt="img">
                    </div>
                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between mb-1">
                            <h6 class="mb-1">Edge</h6>
                            <h6 class="fw-semibold mb-1"><?=$Edg?>%<span
                                    class="text-danger fs-11">(<i
                                        class="fe fe-arrow-down"></i>23.70%)</span></h6>
                        </div>
                        <div class="progress h-2 mb-3">
                            <div class="progress-bar bg-warning" style="width: <?=floor($Edg)?>%;"
                                 role="progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                        <img src="<?=$asset?>/images/browsers/safari.svg" class="img-fluid"
                             alt="img">
                    </div>
                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between mb-1">
                            <h6 class="mb-1">Safari</h6>
                            <h6 class="fw-semibold mb-1"><?=$Safari?>%<span
                                    class="text-success fs-11">(<i
                                        class="fe fe-arrow-up"></i>11.04%)</span></h6>
                        </div>
                        <div class="progress h-2 mb-3">
                            <div class="progress-bar bg-info" style="width: <?=floor($Safari)?>%;"
                                 role="progressbar"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<div class="row pb-5 mb-5">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header pb-0 border-bottom-0">
                <h3 class="card-title">Mobile</h3>
                <div class="card-options">
                        <span class="sales-icon text-primary mx-2 brround bg-primary-transparent p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16" style="width: 50px; height: 50px;">
                                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"></path>
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                            </svg></span>

                </div>
            </div>
            <div class="card-body pt-0">
                <h3 class="d-inline-block mb-2"><?=$mobil?>%</h3>
                <div class="progress h-2 mt-2 mb-2">
                    <div class="progress-bar bg-primary" style="width: <?=floor($mobil)?>%;" role="progressbar"></div>
                </div>
                <div class="float-start">
                    <div class="mt-2">
                        <i class="fa fa-caret-up text-success"></i>
                        <span>12% increase</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COL END -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header pb-0 border-bottom-0">
                <h3 class="card-title">Ordinateur</h3>
                <div class="card-options">
                        <span class="sales-icon text-secondary mx-2 brround bg-secondary-transparent p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor " class="bi bi-display" viewBox="0 0 16 16" style="width: 50px; height: 50px;">
                                <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z"></path> </svg></span>
                </div>
            </div>
            <div class="card-body pt-0">
                <h3 class="d-inline-block mb-2"><?=$nbPc?>%</h3>
                <div class="progress h-2 mt-2 mb-2">
                    <div class="progress-bar bg-info" style="width: <?=floor($nbPc)?>%;" role="progressbar"></div>
                </div>
                <div class="float-start">
                    <div class="mt-2">
                        <i class="fa fa-caret-up text-warning"></i>
                        <span>10% increase</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdComment">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Commentaire de : <span id="nom"></span> </h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="comentUpdForm">
                <div class="modal-body">
                    <div class="updSucces"></div>
                    <div class="updError"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="cat">Vous pouvez modifier le commentaire <i class="required"></i> </label>
                        <textarea class="form-control" placeholder="Nom de la catégorie" rows="10" name="message" id="message" required></textarea>
                        <input type="hidden" class="form-control" name="formkeys" value="<?= $token ?>">
                        <input type="hidden" class="form-control" name="idComment" id="idComment">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent"> <i class="load"></i> Valider la modification</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>









</div>

</div>
</div>

</div>



<?php
require_once 'layout/foot.php';
?>

<script>

    $('#comentUpdForm').submit(function(e){
        e.preventDefault();
        $('.load').html('<i class="loader-btn"></i>');
        var value = document.getElementById('comentUpdForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/update.comment.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            dataType: 'json',
            success: function(data){
//                    alert(data.data_info);
                if(data.data_info == "ok"){
                    tableComment.ajax.reload(null,false);
                    $( "#here" ).load(window.location.href + " #here" );
                    $('.load').html('<i class=""></i>');
                    $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Commentaire modifié avec succès !</div>');
                }else if(data.data_info == ''){

                }
                else {
                    $('.updError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification du commentaire</div>');
                }
            },
            error: function (error, ajaxOptions, thrownError) {
                alert(error.responseText);
            }
        });
    });

    $('#modalUpdComment').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        var nom = $(e.relatedTarget).data('name');
        var description = $(e.relatedTarget).data('message');
        $('#idComment').val(rowid);
        $('#nom').html(nom);
        $('#message').val(description);
    });

    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer le commentaire ?",
                    text: "L'action va supprimer le commentaire",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/delete.comment.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");

                                    $( "#here" ).load(window.location.href + " #here" );

                            }else{
                                swal("Impossible de supprimer le commentaire!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }
</script>

