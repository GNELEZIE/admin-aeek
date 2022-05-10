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
$list = $article->getAllArticle();
if($data = $list->fetch()){
    $nbs = $article->getAllNbrArticle()->fetch();
}

require_once 'layout/header.php';
?>


    <div class="row pt-5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Visiteurs</h6>
                                    <h2 class="mb-0 number-font">278</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <canvas id="saleschart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                        <span class="text-muted fs-12"><span class="text-secondary">
                                <i class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>Last week</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Articles</h6>
                                    <h2 class="mb-0 number-font"><?=$nbs['nb']?></h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <canvas id="leadschart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                                <span class="text-muted fs-12"><span class="text-pink"><i class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>Last 6 days</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Commentaires</h6>
                                    <h2 class="mb-0 number-font">150</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <canvas id="profitchart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                                <span class="text-muted fs-12"><span class="text-green">
                                <i class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>Last 9 days</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Catégories</h6>
                                    <h2 class="mb-0 number-font">765</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <canvas id="costchart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                            <span class="text-muted fs-12"><span class="text-warning"><i class="fe fe-arrow-up-circle text-warning"></i> 0.6%</span>Last year</span>
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
                <h4 class="card-title fw-semibold">Browser Usage</h4>
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
                                <h6 class="fw-semibold mb-1">35,502 <span
                                        class="text-success fs-11">(<i
                                            class="fe fe-arrow-up"></i>12.75%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-primary" style="width: 70%;"
                                     role="progressbar"></div>
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
                                <h6 class="fw-semibold mb-1">12,563 <span
                                        class="text-danger fs-11">(<i
                                            class="fe fe-arrow-down"></i>15.12%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-secondary" style="width: 40%;"
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
                                <h6 class="fw-semibold mb-1">25,364 <span
                                        class="text-success fs-11">(<i
                                            class="fe fe-arrow-down"></i>24.37%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-success" style="width: 50%;"
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
                                <h6 class="fw-semibold mb-1">14,635 <span
                                        class="text-success fs-11">(<i
                                            class="fe fe-arrow-down"></i>15.63%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-danger" style="width: 50%;"
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
                                <h6 class="fw-semibold mb-1">15,453 <span
                                        class="text-danger fs-11">(<i
                                            class="fe fe-arrow-down"></i>23.70%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-warning" style="width: 10%;"
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
                                <h6 class="fw-semibold mb-1">10,054 <span
                                        class="text-success fs-11">(<i
                                            class="fe fe-arrow-up"></i>11.04%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-info" style="width: 40%;"
                                     role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                            <img src="<?=$asset?>/images/browsers/netscape.svg" class="img-fluid"
                                 alt="img">
                        </div>
                        <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                            <div class="d-flex align-items-end justify-content-between mb-1">
                                <h6 class="mb-1">Netscape</h6>
                                <h6 class="fw-semibold mb-1">35,502 <span
                                        class="text-success fs-11">(<i
                                            class="fe fe-arrow-up"></i>12.75%)</span></h6>
                            </div>
                            <div class="progress h-2 mb-3">
                                <div class="progress-bar bg-green" style="width: 30%;"
                                     role="progressbar"></div>
                            </div>
                        </div>
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