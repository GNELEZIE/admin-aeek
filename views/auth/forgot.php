<?php
require_once 'layout/auth/header.php';

require_once 'controller/password.forgot.php';

$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
?>

<div class="container-login100">
    <div class="row">
        <div class="col-md-4 offset-4">
            <div class="wrap-login100 p-6 mt-5 pt-5" style="margin-top: 60px !important;">
                <form class="login100-form validate-form" method="post">
                    <span class="login100-form-title pb-5">Réinitialisation du mot de passe</span>
                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <p>Vous avez oublié votre mot de passe ? Entrez votre adresse e-mail ci-dessous et nous vous enverrons un e-mail pour réinitialisé votre mot de passe.</p>
                        <div class="tab-content pt-3">
                            <?php if(!empty($errors)){ ?>
                                <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                    <?php foreach($errors as $error){ ?>
                                        <?php echo $error ?>
                                    <?php }?>
                                </div>
                            <?php }?>
                            <div class="tab-pane active" id="tab5">
                                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" type="email" name="email" placeholder="Email">
                                    <input type="hidden" class="form-control" name="formkey" value="<?=$token?>">
                                </div>

                                <div class="container-login100-form-btn">
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn btn-orange"> <i class="loader-btn text-white"></i> Réinitialisation</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'layout/auth/footer.php';
?>
