<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeek'])){
    header('location:'.$domaine_admin.'/login?return='.$return);
    exit();
}
$myIp =  Detect::ip();
$result = json_decode(getDataByUrl('http://ip-api.com/json/'.$myIp),true);
if($result['status'] == 'success'){
    $countryCode = $result['countryCode'];
}else{
    $countryCode = 'CI';
}
if($data['phone'] != ''){
    $isoPhone = $data['iso_phone'];
    $dialPhone = $data['dial_phone'];
}else{
    $isoPhone = 'ci';
    $dialPhone = 225;
}

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
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header" style="    border-bottom: 0 !important;">
                                <h3 class="card-title">Modification du profil</h3>
                            </div>
                            <div class="card-body">
                                <form method="post" id="addMembreForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="nom">Nom  <i class="required"></i></label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="<?=html_entity_decode(stripslashes($data['nom']))?>" required>
                                                    <input type="hidden" class="form-control" name="formkey" value="<?=$token?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="prenom">Prénom <i class="required"></i></label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="<?=html_entity_decode(stripslashes($data['prenom']))?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="email">Email <i class="required"></i></label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?=html_entity_decode(stripslashes($data['email']))?> ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="phone">Téléphone <i class="required"></i></label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="tel" class="form-control" name="phone" id="phone" value="<?=$data['phone']?>" required>
                                                    <input type="hidden"  name="isoPhone" id="isoPhone" value="value="<?=$isoPhone?>">
                                                    <input type="hidden"  name="dialPhone" id="dialPhone" value="<?=$dialPhone?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="fonction">Fonction  </label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="fonction" name="fonction" placeholder="nom" value="<?=html_entity_decode(stripslashes($data['fonction']))?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="niveau">Niveau d'étude</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="niveau" name="niveau" placeholder="niveau" value="<?=html_entity_decode(stripslashes($data['niveau']))?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="biographie">Biographie</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" id="biographie" name="biographie" placeholder="biographie" required><?=html_entity_decode(stripslashes($data['biographie']))?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="fonction">Facebook  </label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="url" class="form-control" id="facebook" name="facebook" placeholder="https://facebook.com/nom" value="<?=html_entity_decode(stripslashes($data['facebook']))?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="twitter">Twitter</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="url" class="form-control" id="twitter" name="twitter" placeholder="twitter" value="<?=html_entity_decode(stripslashes($data['twitter']))?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="fonction">Linkedin  </label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="linkedin" value="<?=html_entity_decode(stripslashes($data['linkedin']))?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="twitter">Instagram</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="url" class="form-control" id="instagram" name="instagram" placeholder="instagram" value="<?=html_entity_decode(stripslashes($data['instagram']))?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>





                                    <div class="form-group text-center">
                                        <button class="btn btn-green-transparent"> <i class="load"></i> Ajouter un membre</button>
                                        <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card p-3">
                            <h2 class="font-20 font-bold" style="font-size: 20px !important; font-weight: bold">Ajouter un évènemente</h2>
                            <form method="post" id="eventForm">
                                <div class="row row-sm">
                                    <div class="form-group text-left pl-2">
                                        <label for="nom">Nom de l'évènemente <i class="required"></i> </label>
                                        <input class="form-control" placeholder="Nom de l'évènemente" type="text" name="nom" id="nom" required>
                                        <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-text btn-transparence-orange">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" name="dateEvent" id="dateEvent" placeholder="Date de l'evènement" type="text">
                                        </div>
                                    </div

                                </div>
                                <div class="text-center" style="border-top: 0 !important;">
                                    <button class="btn btn-green-transparent">Ajouter un évènemente</button>
                                </div>
                            </form>
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

    $("#phone").keyup(function (event) {
        if (/\D/g.test(this.value)) {
            //Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    var inputPhone = document.querySelector("#phone");
    window.intlTelInput(inputPhone, {
        initialCountry: '<?=$countryCode?>',
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




</script>

