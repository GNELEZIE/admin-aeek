
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" type="image/x-icon" href="<?=$asset?>/media/logoAEEK.png" />

    <title>Dasboard – <?=ucfirst($page)?> </title>

    <link id="style" href="<?=$asset?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <link href="<?=$asset?>/css/style.css" rel="stylesheet" />
    <link href="<?=$asset?>/css/dark-style.css" rel="stylesheet" />
    <!-- <link href="<?=$asset?>/css/transparent-style.css" rel="stylesheet"> -->
    <link href="<?=$asset?>/css/skin-modes.css" rel="stylesheet" />
    <link href="<?=$asset?>/css/icons.css" rel="stylesheet" />
    <link href="<?=$asset?>/plugins/sweetalert/sweet-alert.css" rel="stylesheet" />
<!--    <link rel="stylesheet" href="--><?//=$asset?><!--/plugins/bootstrap-datepicker/css/datepicker.css" type="text/css"/>-->
<!--    <link rel="stylesheet" href="--><?//=$asset?><!--/plugins/jquery-datetimepicker/jquery.datetimepicker.css" />-->
<!--    <link rel="stylesheet" href="--><?//=$asset?><!--/plugins/bootstrapdatepicker/css/datepicker.css" type="text/css"/>-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=$asset?>/colors/color1.css" />

    <style>
        .desktop-logo{
            max-width: 30% !important;
        }
        .text-noir{
            color: #000000 !important;
        }
        .slide-item.active, .slide-item:hover, .slide-item:focus{
            background: #ff772921 !important;
            color: #ff7729 !important;
        }

        .img-couv{
            object-fit: cover;
            width: 100%;
            height: 300px;
        }
        .sidebar-mini footer.footer {
            padding: 10px !important;
        }
        .input-style{
            border: 2px solid #ced4da;
            border-radius: 6px !important;
        }
        .couverture {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            border: 2px dashed #888ea8;
            border-radius: 6px;
            transition: 0.2s;
            min-height: 200px;
            background: no-repeat center;
            background-size: contain;
        }
        .couverture.is-active {
            background-color: #eff7fa;
        }

        .file-msg {
            text-align: center;
            font-size: small;
            font-weight: 300;
            line-height: 1.4;
        }

        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            cursor: pointer;
            opacity: 0;
        }
        .file-input:focus {
            outline: none;
        }

        button.confirm {

            background-color: rgb(221, 107, 85)  !important;
            box-shadow: rgb(221 107 85 / 80%) 0px 0px 2px, rgb(0 0 0 / 5%) 0px 0px 0px 1px inset  !important;
        }
        button.cancel {

            background-color:#3d38a2 !important;
        }
        table thead tr:first-child th, table thead tr:first-child td {
            text-transform: inherit !important;
        }
        .required:before {
            content: "*";
            color: red;
        }
        .text-left{
          text-align: left !important;
        }
        .btn-transparence-orange {
            background: #ff46003b !important;
            color: #ff4600 !important;
        }
        .btn-green-transparent{
            background: #00a6504a !important;
            color: #0ba053 !important;
            border: none !important;
        }
        .btn-green-transparent:hover{
            background: #00a65085 !important;
            color: #FFFFFF !important;
            border: none !important;
        }
        .btn-red-transparent{
            background: #f900243d !important;
            color: #f90024 !important;
            border: none !important;
        }
        .btn-red-transparent:hover{
            background: #f90024 !important;
            color: #FFFFFF !important;
            border: none !important;
        }
        table tr:hover{
            background: #f0f0f5 !important;
        }
        .table td {
            padding: 7px !important;
        }
        .side-menu .side-menu__icon {
            color: #ff7729 !important;
        }

        /*a:hover {*/
            /*color: #ff7729 !important;*/
        /*}*/
        /*.side-menu__item:hover .side-menu__icon, .side-menu__item:hover .side-menu__label, .side-menu__item:focus .side-menu__icon, .side-menu__item:focus .side-menu__label {*/
            /*color: #fc825f !important;*/
        /*}*/
        /*a:focus, a:active {*/
            /*background: #ff772921  !important;*/
            /*color: #ff7729  !important;*/
        /*}*/



    </style>
</head>

<body class="app sidebar-mini ltr light-mode">

<div id="global-loader">
    <img src="<?=$asset?>/media/loader.svg" class="loader-img" width="100px" alt="Loader">
</div>
<div class="page">
<div class="page-main">

<div class="app-header header sticky">
<div class="container-fluid main-container">
<div class="d-flex">
<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>

<a class="logo-horizontal " href="<?=$domaine_admin?>">
    <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img desktop-logo" alt="logo">
    <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img light-logo1" alt="logo">
</a>

<div class="d-flex order-lg-2 ms-auto header-right-icons">
<div class="dropdown d-none">
    <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
        <i class="fe fe-search"></i>
    </a>
    <div class="dropdown-menu header-search dropdown-menu-start">
        <div class="input-group w-100 p-2">
            <input type="text" class="form-control" placeholder="Search....">
            <div class="input-group-text btn btn-primary">
                <i class="fe fe-search" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>

<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
        aria-controls="navbarSupportedContent-4" aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
</button>
<div class="navbar navbar-collapse responsive-navbar p-0">
<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
    <div class="d-flex order-lg-2">
        <div class="dropdown d-lg-none d-flex">
            <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                <i class="fe fe-search"></i>
            </a>
            <div class="dropdown-menu header-search dropdown-menu-start">
                <div class="input-group w-100 p-2">
                    <input type="text" class="form-control" placeholder="Search....">
                    <div class="input-group-text btn btn-primary">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex country">
            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                <span class="light-layout"><i class="fe fe-sun"></i></span>
            </a>
        </div>

        <div class="dropdown  d-flex notifications">
            <a class="nav-link icon" data-bs-toggle="dropdown"><i
                    class="fe fe-bell"></i><span class=" pulse"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <div class="drop-heading border-bottom">
                    <div class="d-flex">
                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                        </h6>
                    </div>
                </div>
                <div class="notifications-menu">
                    <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                            <i class="fe fe-mail"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                            <h5 class="notification-label mb-1">New Application received
                            </h5>
                            <span class="notification-subtext">3 days ago</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                            <i class="fe fe-check-circle"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                            <h5 class="notification-label mb-1">Project has been
                                approved</h5>
                            <span class="notification-subtext">2 hours ago</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                            <i class="fe fe-shopping-cart"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                            <h5 class="notification-label mb-1">Your Product Delivered
                            </h5>
                            <span class="notification-subtext">30 min ago</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="notify-list.html">
                        <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                            <i class="fe fe-user-plus"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                            <h5 class="notification-label mb-1">Friend Requests</h5>
                            <span class="notification-subtext">1 day ago</span>
                        </div>
                    </a>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a href="notify-list.html"
                   class="dropdown-item text-center p-3 text-muted">View all
                    Notification</a>
            </div>
        </div>
        <div class="dropdown  d-flex message">
            <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                <i class="fe fe-message-square"></i><span class="pulse-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <div class="drop-heading border-bottom">
                    <div class="d-flex">
                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">You have 5
                            Messages</h6>
                        <div class="ms-auto">
                            <a href="javascript:void(0)" class="text-muted p-0 fs-12">make all unread</a>
                        </div>
                    </div>
                </div>
                <div class="message-menu message-menu-scroll">
                    <a class="dropdown-item d-flex" href="chat.html">
                        <span  class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="<?=$asset?>/images/users/1.jpg"></span>
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1">Peter Theil</h5>
                                <small class="text-muted ms-auto text-end">
                                    6:45 am
                                </small>
                            </div>
                            <span>Commented on file Guest list....</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="chat.html">
                        <span class="avatar avatar-md brround me-3 align-self-center cover-image"  data-bs-image-src="<?=$asset?>/images/users/15.jpg"></span>
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1">Abagael Luth</h5>
                                <small class="text-muted ms-auto text-end">
                                    10:35 am
                                </small>
                            </div>
                            <span>New Meetup Started......</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="chat.html">
                        <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="<?=$asset?>/images/users/12.jpg"></span>
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1">Brizid Dawson</h5>
                                <small class="text-muted ms-auto text-end">
                                    2:17 pm
                                </small>
                            </div>
                            <span>Brizid is in the Warehouse...</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="chat.html">
                        <span  class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="<?=$asset?>/images/users/4.jpg"></span>
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1">Shannon Shaw</h5>
                                <small class="text-muted ms-auto text-end">
                                    7:55 pm
                                </small>
                            </div>
                            <span>New Product Realease......</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex" href="chat.html">
                        <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="<?=$asset?>/images/users/3.jpg"></span>
                        <div class="wd-90p">
                            <div class="d-flex">
                                <h5 class="mb-1">Cherry Blossom</h5>
                                <small class="text-muted ms-auto text-end">
                                    7:55 pm
                                </small>
                            </div>
                            <span>You have appointment on......</span>
                        </div>
                    </a>

                </div>
                <div class="dropdown-divider m-0"></div>
                <a href="javascript:void(0)" class="dropdown-item text-center p-3 text-muted">See all
                    Messages</a>
            </div>
        </div>
        <div class="dropdown d-flex header-settings">
            <a href="javascript:void(0);" class="nav-link icon"
               data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                <i class="fe fe-align-right"></i>
            </a>
        </div>

        <div class="dropdown d-flex profile-1">
            <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                <img src="<?=$asset?>/media/user.png" alt="profile-user"
                     class="avatar  profile-user brround cover-image">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <div class="drop-heading">
                    <div class="text-center">
                        <h5 class="text-dark mb-0 fs-14 fw-semibold"><?=html_entity_decode(stripslashes($data['nom'])).' '.html_entity_decode(stripslashes($data['prenom']))?></h5>
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item" href="<?=$domaine_admin?>/profil">
                    <i class="dropdown-icon fe fe-user"></i> Profil
                </a>
                <?php  if($data['role'] !=0){
                ?>
                    <a class="dropdown-item" href="<?=$domaine_admin?>/membre">
                        <i class="dropdown-icon fe fe-user"></i> Membre
                    </a>
                <?php
                }
                ?>

                <a class="dropdown-item" href="<?=$domaine_admin?>/logout">
                    <i class="dropdown-icon fe fe-alert-circle"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php include_once 'sidebar.php' ; ?>

<div class="main-content app-content mt-0">
    <div class="side-app">


        <div class="main-container container-fluid">

