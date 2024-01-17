<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeek'])){
    header('location:'.$domaine_admin.'/connexion?return='.$return);
    exit();
}
require_once 'controller/password-update.php';


$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php';
?>
<div class="main-content app-content mt-0">
<div class="side-app">
    <div class="main-container container-fluid">
        <div class="container mt-5 pt-5">
            <div class="row mt-5 pt-5">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header" style="    border-bottom: 0 !important;">
                            <h3 class="card-title">Modifier le mot de passe</h3>
                        </div>
                        <div class="card-body">

                            <form method="post" id="updProfilForm">
                                <?php if(!empty($success)){ ?>
                                    <div class="alert alert-success" style="font-size: 14px" role="alert">
                                        <?php foreach($success as $succ){ ?>
                                            <?php echo $succ ?>
                                        <?php }?>
                                    </div>
                                <?php }?>
                                <?php if(!empty($errors)){ ?>
                                    <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                        <?php foreach($errors as $error){ ?>
                                            <?php echo $error ?>
                                        <?php }?>
                                    </div>
                                <?php }?>
                                <div class="row">

                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="a_passsword">Ancien mot de passe  <i class="required"></i></label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" id="a_passsword" name="a_passsword" placeholder="Ancien mot de passe" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="n_password">Nouveau mot de passe <i class="required"></i></label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe " required>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="c_password">Confirmer mot de passe<i class="required"></i></label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirmer mot de passe" required>
                                            </div>
                                        </div>
                                    </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <input type="hidden" class="form-control" name="formkey" value="<?=$token?>">
                                            <button class="btn btn-transparence-orange"> <i class="load"></i> <i class="fa fa-edit"></i> Modifier</button>
                                        </div>
                                    </div>
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

    $('#updProfilForm').submit(function(e){
        $('.load').html('<i class="loader-btn"></i>');
    });
    $('#btn-img').click(function(e){
        e.preventDefault();
        $('#userImg').trigger('click');
    });




</script>

