<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                          fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg></div>
    <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item <?php if($lien == 'dashboard' || $lien == ''){echo 'current';} ;?>" data-bs-toggle="slide" href="<?=$domaine_admin?>/dashboard"><i
                    class="side-menu__icon fe fe-home"></i><span
                    class="side-menu__label">Dashboard</span></a>
        </li>

        <li>
            <a class="side-menu__item <?php if($lien == 'add-categorie'){echo 'current';} ;?>" href="<?=$domaine_admin?>/add-categorie"><i class="side-menu__icon fe fe-list"></i>
                <span class="side-menu__label">Catégorie</span>
            </a>
        </li>
        <li>
            <a class="side-menu__item <?php if($lien == 'tag'){echo 'current';} ;?>" href="<?=$domaine_admin?>/tag"><i class="side-menu__icon fe fe-tag"></i>
                <span class="side-menu__label">Tag</span>
            </a>
        </li>
        <li>
            <a class="side-menu__item <?php if($lien == 'blog'){echo 'current';} ;?>" href="<?=$domaine_admin?>/blog">
                <i class="side-menu__icon fe fe-file-text"></i>
                <span class="side-menu__label">Blog</span>
            </a>
        </li>
        <li>
            <a class="side-menu__item <?php if($lien == 'commentaire'){echo 'current';} ;?>" href="<?=$domaine_admin?>/commentaire">
                <i class="side-menu__icon fe fe-message-square"></i>
                <span class="side-menu__label">Commentaire</span>
            </a>
        </li>
        <?php  if($data['role'] !=0){
            ?>
            <li>
                <a class="side-menu__item <?php if($lien == 'vote'){echo 'current';} ;?>" href="<?=$domaine_admin?>/vote">
                    <i class="side-menu__icon fe fe-message-square"></i>
                    <span class="side-menu__label">Vote</span>
                </a>
            </li>
            <li>
                <a class="side-menu__item <?php if($lien == 'caofa'){echo 'current';} ;?>" href="<?=$domaine_admin?>/caofa"><i class="side-menu__icon fe fe-list"></i>
                    <span class="side-menu__label">caofa</span>
                </a>
            </li>
            <li>
                <a class="side-menu__item <?php if($lien == 'banniere'){echo 'current';} ;?>" href="<?=$domaine_admin?>/banniere">
                    <i class="side-menu__icon fe fe-square"></i>
                    <span class="side-menu__label">Bannière</span>
                </a>
            </li>
        <?php
        }
        ?>

        <li>
            <a class="side-menu__item <?php if($lien == 'gallerie'){echo 'current';} ;?>" href="<?=$domaine_admin?>/gallerie">
                <i class="side-menu__icon fe fe-camera"></i>
                <span class="side-menu__label">Gallerie</span>
            </a>
        </li>
        <li>
            <a class="side-menu__item <?php if($lien == 'flash'){echo 'current';} ;?>" href="<?=$domaine_admin?>/flash">
                <i class="side-menu__icon fe fe-briefcase"></i>
                <span class="side-menu__label">Flash infos</span>
            </a>
        </li>
        <li>
            <a class="side-menu__item <?php if($lien == 'reunion'){echo 'current';} ;?>" href="<?=$domaine_admin?>/reunion">
                <i class="side-menu__icon fa fa-tv"></i>
                <span class="side-menu__label">Réunion</span>
            </a>
        </li>
        <?php  if($data['role'] !=0){
            ?>
            <li class="slide">
                <a class="side-menu__item <?php if($lien == 'emplois'){echo 'current';} ;?>" data-bs-toggle="slide" href="javascript:void(0)">
                    <i class="side-menu__icon fe fe-briefcase"></i>
                    <span class="side-menu__label">Offre d'emplois</span>
                    <i class="angle fe fe-chevron-right"></i>
                </a>
                <ul class="slide-menu">
                    <li>
                        <a href="<?=$domaine_admin?>/emplois" class="slide-item  <?php if($lien == 'emplois' || $lien == 'offre-externe'){echo 'current';} ;?>">
                            <i class="side-menu__icon fe fe-briefcase"></i>
                            <span class="side-menu__label">La liste des offres</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$domaine_admin?>/offre-externe" class="slide-item  <?php if($lien == 'offre-externe'){echo 'current';} ;?>">
                            <i class="side-menu__icon fe fe-briefcase"></i>
                            <span class="side-menu__label">Offre exterieur</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$domaine_admin?>/gallerie" class="slide-item">
                            <i class="side-menu__icon fe fe-briefcase"></i>
                            <span class="side-menu__label">Offre interieur</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="side-menu__item <?php if($lien == 'inscrit'){echo 'current';} ;?>" href="<?=$domaine_admin?>/inscrit">
                    <i class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Inscrits</span>
                </a>
            </li>
            <li>
                <a class="side-menu__item <?php if($lien == 'a-propos'){echo 'current';} ;?>" href="<?=$domaine_admin?>/a-propos">
                    <i class="side-menu__icon fe fe-folder"></i>
                    <span class="side-menu__label">A propos</span>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
    <div class="slide-right" id="slide-right">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg>
    </div>
</div>