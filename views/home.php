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
if($data = $list->fetch()){
    $nbs = $article->getAllNbrArticle()->fetch();
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
$nbTotComment = $nbsComt + $nbsR;
require_once 'layout/header.php';
?>


    <div class="row pt-5">
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
        <!-- COL END -->
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
                            <h2 class="mb-0 number-font"><?=$nbTotComment?></h2>
                            <p class="text-white mb-0">Commentaires</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
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
                            <h2 class="mb-0 number-font"><?=$nbs['nb']?></h2>
                            <p class="text-white mb-0">Articles</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    <div class="row">
    <div class="col-xl-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title fw-semibold">Commentaire en attente</h4>
            </div>
            <div class="card-body pb-0">
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
                                        href="javascript:void(0)" class="fw-semibold"> Voir l'article</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span
                                        class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                    <?php
                    }
                    ?>




                    <!--                    <li class="d-sm-flex">-->
                    <!--                        <div>-->
                    <!--                            <i class="task-icon bg-success"></i>-->
                    <!--                            <h6 class="fw-semibold">New Comment<span-->
                    <!--                                    class="text-muted fs-11 mx-2 fw-normal">25 June 2021</span>-->
                    <!--                            </h6>-->
                    <!--                            <p class="text-muted fs-12">Victoria commented on Project <a-->
                    <!--                                    href="javascript:void(0)" class="fw-semibold"> AngularJS Template</a></p>-->
                    <!--                        </div>-->
                    <!--                        <div class="ms-auto d-md-flex">-->
                    <!--                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"-->
                    <!--                               data-bs-placement="top" title="Edit" aria-label="Edit"><span-->
                    <!--                                    class="fe fe-edit"></span></a>-->
                    <!--                            <a href="javascript:void(0)" class="text-muted"><span-->
                    <!--                                    class="fe fe-trash-2"></span></a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                    <li class="d-sm-flex">-->
                    <!--                        <div>-->
                    <!--                            <i class="task-icon bg-warning"></i>-->
                    <!--                            <h6 class="fw-semibold">Task Overdue<span-->
                    <!--                                    class="text-muted fs-11 mx-2 fw-normal">14 June 2021</span>-->
                    <!--                            </h6>-->
                    <!--                            <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a-->
                    <!--                                    href="javascript:void(0)" class="fw-semibold"> Integrated management</a></p>-->
                    <!--                        </div>-->
                    <!--                        <div class="ms-auto d-md-flex">-->
                    <!--                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"-->
                    <!--                               data-bs-placement="top" title="Edit" aria-label="Edit"><span-->
                    <!--                                    class="fe fe-edit"></span></a>-->
                    <!--                            <a href="javascript:void(0)" class="text-muted"><span-->
                    <!--                                    class="fe fe-trash-2"></span></a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                    <li class="d-sm-flex">-->
                    <!--                        <div>-->
                    <!--                            <i class="task-icon bg-danger"></i>-->
                    <!--                            <h6 class="fw-semibold">Task Overdue<span-->
                    <!--                                    class="text-muted fs-11 mx-2 fw-normal">29 June 2021</span>-->
                    <!--                            </h6>-->
                    <!--                            <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a-->
                    <!--                                    href="javascript:void(0)" class="fw-semibold"> Integrated management</a></p>-->
                    <!--                        </div>-->
                    <!--                        <div class="ms-auto d-md-flex">-->
                    <!--                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"-->
                    <!--                               data-bs-placement="top" title="Edit" aria-label="Edit"><span-->
                    <!--                                    class="fe fe-edit"></span></a>-->
                    <!--                            <a href="javascript:void(0)" class="text-muted"><span-->
                    <!--                                    class="fe fe-trash-2"></span></a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                    <li class="d-sm-flex">-->
                    <!--                        <div>-->
                    <!--                            <i class="task-icon bg-info"></i>-->
                    <!--                            <h6 class="fw-semibold">Task Finished<span-->
                    <!--                                    class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span>-->
                    <!--                            </h6>-->
                    <!--                            <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"-->
                    <!--                                                                                      class="fw-semibold"> Project Management</a></p>-->
                    <!--                        </div>-->
                    <!--                        <div class="ms-auto d-md-flex">-->
                    <!--                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"-->
                    <!--                               data-bs-placement="top" title="Edit" aria-label="Edit"><span-->
                    <!--                                    class="fe fe-edit"></span></a>-->
                    <!--                            <a href="javascript:void(0)" class="text-muted"><span-->
                    <!--                                    class="fe fe-trash-2"></span></a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
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
                        <a class="btn btn-sm btn-primary" href="javascript:void(0)"><i class="fa fa-mobile mb-0" style="font-size: 45px;"></i></a>
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
                        <a class="btn btn-sm btn-warning" href="javascript:void(0)"><i class="fa fa-desktop mb-0"  style="font-size: 45px;"></i></a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <h3 class="d-inline-block mb-2"><?=$nbPc?>%</h3>
                    <div class="progress h-2 mt-2 mb-2">
                        <div class="progress-bar bg-warning" style="width: <?=floor($nbPc)?>%;" role="progressbar"></div>
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

    <div class="sidebar sidebar-right sidebar-animate">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
    <div class="tab-menu-heading border-0 d-flex p-3">
        <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span
                class=" pulse"></span>Notifications</div>
        <div class="card-options ms-auto">
            <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
               data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i
                    class="fe fe-x text-white"></i></a>
        </div>
    </div>
    <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
    <div class="tabs-menu border-bottom">
        <!-- Tabs -->
        <ul class="nav panel-tabs">
            <li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i
                        class="fe fe-settings me-1"></i>Feeds</a></li>
            <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-message-circle"></i> Chat</a></li>
            <li><a href="#side3" data-bs-toggle="tab"><i class="fe fe-anchor me-1"></i>Timeline</a></li>
        </ul>
    </div>
    <div class="tab-content">
    <div class="tab-pane active" id="side1">
        <div class="p-3 fw-semibold ps-5">Feeds</div>
        <div class="card-body pt-2">
            <div class="browser-stats">
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle brround bg-primary-transparent"><i
                                                    class="fe fe-user text-primary"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">New user registered</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i
                                                    class="fe fe-shopping-cart text-secondary"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">New order delivered</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-bell text-danger"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">You have pending tasks</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i
                                                    class="fe fe-gitlab text-warning"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">New version arrived</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i
                                                    class="fe fe-database text-pink"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">Server #1 overloaded</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-info brround bg-info-transparent"><i
                                                    class="fe fe-check-circle text-info"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">New project launched</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 fw-semibold ps-5">Settings</div>
        <div class="card-body pt-2">
            <div class="browser-stats">
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle brround bg-primary-transparent"><i
                                                    class="fe fe-settings text-primary"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">General Settings</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i
                                                    class="fe fe-map-pin text-secondary"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">Map Settings</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-headphones text-danger"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">Support Settings</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i
                                                    class="fe fe-credit-card text-warning"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">Payment Settings</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i
                                                    class="fe fe-bell text-pink"></i></span>
                    </div>
                    <div class="col-sm-10 ps-sm-0">
                        <div class="d-flex align-items-end justify-content-between ms-2">
                            <h6 class="">Notification Settings</h6>
                            <div>
                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="side2">
        <div class="list-group list-group-flush">
            <div class="pt-3 fw-semibold ps-5">Today</div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/2.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Addie Minstra</div>
                        <p class="mb-0 fs-12 text-muted"> Hey! there I' am available.... </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/11.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Rose Bush</div>
                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/10.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Claude Strophobia</div>
                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                        </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/13.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Eileen Dover</div>
                        <p class="mb-0 fs-12 text-muted"> New product Launching... </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/12.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Willie Findit</div>
                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/15.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Manny Jah</div>
                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                        </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/4.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Cherry Blossom</div>
                        <p class="mb-0 fs-12 text-muted"> Hey! there I' am available....</p>
                    </a>
                </div>
            </div>
            <div class="pt-3 fw-semibold ps-5">Yesterday</div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/7.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Simon Sais</div>
                        <p class="mb-0 fs-12 text-muted">Schedule Realease...... </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/9.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Laura Biding</div>
                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                        </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/2.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Addie Minstra</div>
                        <p class="mb-0 fs-12 text-muted">Contact me for details....</p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/9.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Ivan Notheridiya</div>
                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                        </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/14.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Dulcie Veeta</div>
                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/11.jpg"></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Florinda Carasco</div>
                        <p class="mb-0 fs-12 text-muted">New product Launching...</p>
                    </a>
                </div>
            </div>
            <div class="list-group-item d-flex align-items-center">
                <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                              data-bs-image-src="<?=$asset?>/images/users/4.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                </div>
                <div class="">
                    <a href="chat.html">
                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                             data-target="#chatmodel">Cherry Blossom</div>
                        <p class="mb-0 fs-12 text-muted">cherryblossom@gmail.com</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="side3">
        <ul class="task-list timeline-task">
            <li class="d-sm-flex mt-4">
                <div>
                    <i class="task-icon1"></i>
                    <h6 class="fw-semibold">Task Finished<span
                            class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span></h6>
                    <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                                                              class="fw-semibold"> Project Management</a></p>
                </div>
                <div class="ms-auto d-md-flex me-3">
                    <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                    <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                </div>
            </li>
            <li class="d-sm-flex">
                <div>
                    <i class="task-icon1"></i>
                    <h6 class="fw-semibold">New Comment<span
                            class="text-muted fs-11 mx-2 fw-normal">05 July 2021</span></h6>
                    <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                                                                 class="fw-semibold"> AngularJS Template</a></p>
                </div>
                <div class="ms-auto d-md-flex me-3">
                    <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                    <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                </div>
            </li>
            <li class="d-sm-flex">
                <div>
                    <i class="task-icon1"></i>
                    <h6 class="fw-semibold">New Comment<span
                            class="text-muted fs-11 mx-2 fw-normal">25 June 2021</span></h6>
                    <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                                                                 class="fw-semibold"> AngularJS Template</a></p>
                </div>
                <div class="ms-auto d-md-flex me-3">
                    <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                    <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                </div>
            </li>
            <li class="d-sm-flex">
                <div>
                    <i class="task-icon1"></i>
                    <h6 class="fw-semibold">Task Overdue<span
                            class="text-muted fs-11 mx-2 fw-normal">14 June 2021</span></h6>
                    <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)"
                                                                                    class="fw-semibold"> Integrated management</a></p>
                </div>
                <div class="ms-auto d-md-flex me-3">
                    <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                    <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                </div>
            </li>
            <li class="d-sm-flex">
                <div>
                    <i class="task-icon1"></i>
                    <h6 class="fw-semibold">Task Overdue<span
                            class="text-muted fs-11 mx-2 fw-normal">29 June 2021</span></h6>
                    <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)"
                                                                                    class="fw-semibold"> Integrated management</a></p>
                </div>
                <div class="ms-auto d-md-flex me-3">
                    <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                    <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                </div>
            </li>
            <li class="d-sm-flex">
                <div>
                    <i class="task-icon1"></i>
                    <h6 class="fw-semibold">Task Finished<span
                            class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span></h6>
                    <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                                                              class="fw-semibold"> Project Management</a></p>
                </div>
                <div class="ms-auto d-md-flex me-3">
                    <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                    <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                </div>
            </li>
        </ul>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="country-selector">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close"
                                                                       data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <ul class="row p-3">
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active">
                                    <span class="country-selector"><img alt="" src="<?=$asset?>/images/flags/us_flag.jpg"
                                                                        class="me-3 language"></span>USA
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/italy_flag.jpg"
                                                                        class="me-3 language"></span>Italy
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/spain_flag.jpg"
                                                                        class="me-3 language"></span>Spain
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/india_flag.jpg"
                                                                        class="me-3 language"></span>India
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/french_flag.jpg"
                                                                        class="me-3 language"></span>French
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/russia_flag.jpg"
                                                                        class="me-3 language"></span>Russia
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/germany_flag.jpg"
                                                                        class="me-3 language"></span>Germany
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                                                        src="<?=$asset?>/images/flags/argentina.jpg"
                                                                        class="me-3 language"></span>Argentina
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="<?=$asset?>/images/flags/malaysia.jpg"
                                                                        class="me-3 language"></span>Malaysia
                            </a>
                        </li>
                        <li class="col-lg-6 mb-2">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="<?=$asset?>/images/flags/turkey.jpg"
                                                                        class="me-3 language"></span>Turkey
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'layout/footer.php';
?>