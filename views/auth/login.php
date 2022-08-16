<?php
require_once 'layout/auth/header.php';
require_once 'controller/admin.connexion.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
?>

<div class="container-login100">
    <div class="wrap-login100 p-6 mt-5 pt-5" style="margin-top: 150px !important;">
        <form class="login100-form validate-form" method="post" id="loginForm">
            <span class="login100-form-title pb-5">Connexion</span>
                <div class="panel-body tabs-menu-body p-0 pt-5">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab5">
                            <?php if(!empty($errors)){ ?>
                                <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                    <?php foreach($errors as $error){ ?>
                                        <?php echo $error ?>
                                    <?php }?>
                                </div>
                            <?php }?>
                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" type="email" name="email" placeholder="Email" required>
                                <input type="hidden" class="form-control" name="formkey" value="<?=$token?>">
                            </div>
                            <div class="wrap-input100 validate-input input-group pt-3" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" type="password" name="password" placeholder="Mot de passe" required>
                            </div>
                            <div class="text-end pt-4">
                                <p class="mb-0"><a href="<?=$domaine_admin?>/forgot" class="text-orange ms-1">Mot de passe oublié</a></p>
                            </div>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-orange"> <i class="loader"></i> Connexion</button>
                            </div>

                        </div>
                    </div>
                </div>

        </form>
    </div>
</div>
<?php
require_once 'layout/auth/footer.php';
?>
<script>
    $(document).ready(function(){
        $('#loginForm').submit(function(e) {
            $('.loader').html(' <i class="loader-btn text-white"></i> ');
        });
    });
</script>