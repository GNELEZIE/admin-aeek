<!doctype html>
<html lang="en" dir="ltr">

<head>

<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Admin aeek Kasséré">
<meta name="author" content="Gnelezie Ouattara">

<link rel="shortcut icon" type="image/x-icon" href="<?=$asset?>/media/logoAEEK.png" />

<title>Dasboard – <?=ucfirst($page)?></title>

<link id="style" href="<?=$asset?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<link href="<?=$asset?>/css/style.css" rel="stylesheet" />
<link href="<?=$asset?>/css/dark-style.css" rel="stylesheet" />
<link href="<?=$asset?>/css/skin-modes.css" rel="stylesheet" />
<link href="<?=$asset?>/css/icons.css" rel="stylesheet" />
<link href="<?=$asset?>/plugins/sweetalert/sweet-alert.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=$asset?>/plugins/bootstrap-datepicker/css/datepicker.css" type="text/css"/>
<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=$asset?>/colors/color1.css" />
<link rel="stylesheet" href="<?=$asset?>/plugins/intltelinput/css/intlTelInput.min.css"/>

<link rel="stylesheet" href="<?=$asset?>/plugins/datatable/datatables.min.css">
<link rel="stylesheet" href="<?=$asset?>/plugins/datatable/buttons.dataTables.min.css">
<style>
td{
    vertical-align: middle !important;
}
.badge-disable{
    background-color: rgba(192, 198, 205, 0.13);
    border-radius: 6px;
    transition: all 0.2s ease-in-out;
    font-size: 11px;
    font-weight: 500;
    padding: 2px 5px;
    vertical-align: middle;
    border: none;
}

.badge-green{
    color: #2ab57d;
    background-color: rgba(42, 181, 125, 0.13);
    border-radius: 6px;
    transition: all 0.2s ease-in-out;
    font-size: 11px;
    font-weight: 500;
    padding: 2px 5px;
    vertical-align: middle;
    border: none;
}

.badge-red{
    color: #fd625e;
    background-color: rgba(253, 98, 94, 0.13);
    border-radius: 6px;
    transition: all 0.2s ease-in-out;
    font-size: 11px;
    font-weight: 500;
    padding: 2px 5px;
    vertical-align: middle;
    border: none;
}
.img-cand{
    border-radius: 50% !important;
    width: 66px !important;
    height: 66px !important;
}
#imguser{
    border-radius: 6px 6px 0 0 !important;
}
.bgimg2{
    background: url("<?=$assets?>/media/aeek-2.jpeg") !important;
    background-size: cover !important;
    background-position: top !important;
}
.badge-dim.badge-danger {
    color: #e85347 !important;
    background-color: #fceceb !important;
    border-color: #fceceb !important;
}
.iti, .select2-container{
    width: 100% !important;
}
.current{
    background: #ff46000f !important;
    color: #ff4600 !important;
    border-radius: 6px !important;

}
.gallerie-img{
    object-fit: cover;
    height: 250px !important;
}
.mytrash{
    color: transparent;
    text-align: right;
}
.mytrash:hover{
    color: #ff0085;
}
.text-red{
    color: #ff0000;
}
.supicon{
    position: absolute;
    right: 31px;
    top: 15px;
}



.mytrash a:hover{
    color: #ff0085;
}
.supimg{
    position: absolute;
    right: 24px;
    top: 10px;
}

.datepicker.dropdown-menu{
    z-index: 99999 !important;
}
.datepicker table tr td.active.active{
    background : #f87405 !important;
}
.card-img-absolute {
    margin-left: 11px !important;
}
#back-to-top {
    color: #f87405 !important;
    border: none !important;
    background: rgb(248 116 5 / 15%) !important
}
#back-to-top:hover {
    color: #f87405 !important;
    border: 2px solid #f87405;
}
.loader-btn {
    display: inline-block;
    width: 0.9rem;
    height: 0.9rem;
    vertical-align: middle;
    border: 0.2em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: spinner-border .75s linear infinite;
    animation: spinner-border .75s linear infinite;
    align-self: center;
}
.page-item.active .page-link {
    color: #fff !important;
    background-color: #ff4600 !important;
    border-color: #ff4600 !important;
}

div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    margin-bottom: 17px !important;
}


/*.side-menu__item{*/
/*color: #282f53 !important;*/
/*}*/

.side-menu__item:hover{
    background: #ff46000f !important;
    color: #ff4600 !important;
    padding: 3px 20px !important;
    border-radius: 6px !important;
}
.side-menu__label:hover{
    color: #ff4600 !important;
}
.side-menu__item{
    padding: 3px 20px !important;
    margin: 10px 0 !important;
}
.sidebar-mini .side-menu {
    margin-top: 45px !important;
}
/*.side-menu__item:focus{*/
/*background: #ff7729 !important; ;*/
/*}*/
.desktop-logo,.toggle-logo, .light-logo, .light-logo1{
    max-width: 30% !important;
}
.text-noir{
    color: #282f53 ;
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
.logo {
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
.logo.is-active {
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
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background: #00a6501a !important;
    color: #0ba053 !important;
    border: none !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    color: #0ba053 !important;
}
.ui-state-default:hover{
    background: #ff4600 !important;
    border: none !important;
}
.ui-datepicker .ui-datepicker-calendar .ui-datepicker-today a {
    background-color: #ffd4c4 !important;
    color: #ff4600 !important;
    border: none !important;
}

.bg-transparence-warning {
    background: #f7b7312e !important;
    color: #f7b731 !important;
}
.bg-transparence-warning:hover{
    background: #f7b731 !important;
    color: #FFFFFF !important;
}
.btn-transparence-info {
    color: #1170e4 !important;
    background: #1170e447 !important;
}
.btn-transparence-dark {
    color: #000000 !important;
    background: rgba(0, 0, 0, 0.35) !important;
}
.btn-transparence-purple {
    color: #6c5ffc !important;
    background: #6c5ffc6b !important;
}
.btn-transparence-info:hover{
    color: #FFFFFF !important;
    background: #1170e4 !important;
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
.pbtn{
    padding: 5px 7px;
    border-radius: 6px;
    color: #1170e4 !important;
    background: rgba(17, 112, 228, 0.20) !important;
}
.text-bold{
    font-weight: bold;
}
.btn-green-transparent:hover{
    background: #00a65085 !important;
    color: #FFFFFF !important;
    border: none !important;
}
.btn-info-transparent{
    background: #05c3fb29 !important;
    color: #05c3fb !important;
    border: none !important;
}
.btn-info-transparent:hover{
    background: #05c3fb !important;
    color: #fff !important;
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
    background: #f0f0f55c !important;
}
.table td {
    padding: 7px !important;
}
.side-menu .side-menu__icon {
    color: inherit !important;
}
.side-menu .side-menu__icon :hover {
    color: inherit !important;
}

.font-7{
    font-size: 7px !important;
}
.font-8{
    font-size: 8px !important;
}
.font-9{
    font-size: 9px !important;
}
.font-10{
    font-size: 10px !important;
}
.font-11{
    font-size: 11px !important;
}
.font-12{
    font-size: 12px !important;
}
.font-13{
    font-size: 13px !important;
}
.app-content{
    margin-left: 260px;
}


@media(max-width: 767px) {
.col-50-mobile{
    width: 50% !important;
}
    .p-0-mobile{
        padding: 0 !important;
    }

    .p-5-mobile{
        padding: 5px !important;
    }

.desktop-logo, .toggle-logo, .light-logo, .light-logo1 {
        max-width: 12% !important;
    }
.pl-0-mobile{
    padding-left: 0 !important;
}
.mr-0-mobile{
    margin-right: 0 !important;
}
.ml-0-mobile{
    margin-left: 0 !important;
}

.p-10-mobile{
    padding: 10px !important;
}






}

@media(max-width: 370px) {

}
@media(max-width: 330px) {

}

@media(min-width: 1250px) {

}










</style>
</head>

<body class="app sidebar-mini ltr light-mode">

<div id="global-loader">
    <img src="<?=$asset?>/media/loader.svg" class="loader-img" width="100px" alt="Loader">
</div>

<div class="page">
<div class="page-main">

<!-- app-Header -->
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
<!-- SEARCH -->
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

<!-- COUNTRY -->
<div class="d-flex country">
    <a class="nav-link icon theme-layout nav-link-bg layout-setting">
        <span class="dark-layout"><i class="fe fe-moon"></i></span>
        <span class="light-layout"><i class="fe fe-sun"></i></span>
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

        <a class="dropdown-item" href="<?=$domaine_admin?>/mot-de-passe">
            <i class="dropdown-icon fe fe-lock"></i> Mot de passe
        </a>
        <?php  if($data['role'] ==1){
            ?>
            <a class="dropdown-item" href="<?=$domaine_admin?>/membres">
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

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="<?=$domaine_admin?>">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img toggle-logo"
                     alt="logo">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img light-logo" alt="logo">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img light-logo1"
                     alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <?php include_once "layout/side.php"
        ?>
    </div>
    <!--/APP-SIDEBAR-->
</div>
