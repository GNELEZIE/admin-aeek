<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="<?=$domaine_admin?>">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img desktop-logo" width="10" alt="logo">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img toggle-logo" width="10" alt="logo">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img light-logo" width="10" alt="logo">
                <img src="<?=$asset?>/media/logoAEEK.png" class="header-brand-img light-logo1" width="10"  alt="logo" style="    width: 50px;">
            </a>

        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                                  fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="slide-item" href="<?=$domaine_admin?>/home">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li >
                    <a class="slide-item" href="<?=$domaine_admin?>/add-categorie">
                        <i class="side-menu__icon fe fe-home"></i>
                       Catégorie
                    </a>
                </li>
                <li class="is-expanded">
                    <a class="slide-item" href="<?=$domaine_admin?>/blog">
                        <i class="side-menu__icon fe fe-home"></i>
                        Blog
                    </a>
                </li>
                <li class="is-expanded">
                    <a class="slide-item" href="<?=$domaine_admin?>/banniere">
                        <i class="side-menu__icon fe fe-home"></i>
                        Bannière
                    </a>
                </li>
                <li class="is-expanded">
                    <a class="slide-item" href="<?=$domaine_admin?>/commentaire">
                        <i class="side-menu__icon fa fa-commenting"></i>
                        Commentaires
                    </a>
                </li>
                <li class="is-expanded">
                    <a class="slide-item" href="<?=$domaine_admin?>/gallerie">
                        <i class="side-menu__icon fa fa-camera"></i>
                        Gallerie
                    </a>
                </li>
                <li class="is-expanded">
                    <a class="slide-item" href="<?=$domaine_admin?>/flash">
                        <i class="side-menu__icon fa fa-camera"></i>
                        Flash info
                    </a>
                </li>


            </ul>

        </div>

    </div>