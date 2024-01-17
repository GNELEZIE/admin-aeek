<?php
require_once 'layout/auth/header.php';
require_once 'controller/can.connexion.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
?>

<div class="container-fluid">
    <div class="row mt-5 pt-5" style="margin-top: 150px !important;">
        <div class="col-md-4 offset-4">
            <div class="card p-5 bg-white">
                <h2 class="text-center text-bold"> <i class="fa fa-user"></i> Connexion </h2>
                <form class="" method="post" id="loginForm">
                    <?php if(!empty($errors)){ ?>
                        <div class="alert alert-danger" style="font-size: 14px" role="alert">
                            <?php foreach($errors as $error){ ?>
                                <?php echo $error ?>
                            <?php }?>
                        </div>
                    <?php }?>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="phone">Téléphone <i class="required"></i></label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="tel" class="form-control" name="phone" id="phone" value="" required>
                            <input type="hidden"  name="isoPhone" id="isoPhone" value="value="">
                            <input type="hidden"  name="dialPhone" id="dialPhone" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Mot de passe <i class="required"></i></label>
                        </div>
                        <div class="form-control-wrap">
                            <div class="wrap-input100 validate-input input-group pt-3" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                </a>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" value="" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="formkey" value="<?=$token?>">
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn btn-orange"> <i class="loader"></i> Connexion</button>
                    </div>
                </form>
            </div>
        </div>
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


        $("#phone").keyup(function (event) {
            if (/\D/g.test(this.value)) {
                //Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });

        var inputPhone = document.querySelector("#phone");
        window.intlTelInput(inputPhone, {
            initialCountry: 'ci',
            utilsScript: "<?=$asset?>/plugins/intltelinput/js/utils.js"
        });
        var iti = window.intlTelInputGlobals.getInstance(inputPhone);
        var countryData = iti.getSelectedCountryData();
        $('#isoPhone').val(countryData["iso2"]);
        $('#dialPhone').val(countryData["dialCode"]);
        inputPhone.addEventListener("countrychange", function() {
            var iti = window.intlTelInputGlobals.getInstance(inputPhone);
            var countryData = iti.getSelectedCountryData();
            $('#isoPhone').val(countryData["iso2"]);
            $('#dialPhone').val(countryData["dialCode"]);
        });

    });
</script>