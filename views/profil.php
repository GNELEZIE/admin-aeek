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
require_once 'controller/admin.update.php';
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
                            <?php
                            if(isset($_SESSION['_valid'])){
                                $mailTexts = explode('@',html_entity_decode(stripslashes($_SESSION['_valid']['email'])));
                                $masqueUpdateMail = mb_substr($mailTexts[0],0,2,'UTF-8').'***@'.$mailTexts[1];
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <p class="alert-heading" style="color: #842029;"><em class="icon ni ni-alert-fill-c"></em> Modification de l'email en cours ...</p>
                                    <p class="m-0">Nous vous avons envoyé un email de confirmation à <?=$masqueUpdateMail?>.</p>
                                    <p class="m-0"> Vérifier vos spams si vous ne voyez pas le mail.</p>
                                    <hr>
                                    <p class="mb-0">Veuillez par la suite confirmer votre adresse e-mail en cliquant sur le lien "<b>Confirmer mon email</b>".</p>
                                </div>

                            <?php
                            }
                            ?>
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
                                                <input type="url" class="form-control" id="twitter" name="twitter" placeholder="https://twitter.com/@nom" value="<?=html_entity_decode(stripslashes($data['twitter']))?>" >
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
                                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="https://www.linkedin.com/in/nom" value="<?=html_entity_decode(stripslashes($data['linkedin']))?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="twitter">Instagram</label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="url" class="form-control" id="instagram" name="instagram" placeholder="https://www.instagram.com/nom" value="<?=html_entity_decode(stripslashes($data['instagram']))?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button class="btn btn-transparence-orange"> <i class="load"></i> <i class="fa fa-edit"></i> Modifier mon profil</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card border-0 mb-0" style="box-shadow: none !important;">
                            <img src="<?=$domaine?>/uploads/<?php if($data['photo'] != ''){echo $data['photo'];}else{echo 'default.png';}?>" alt="<?=html_entity_decode(stripslashes($data['nom']))?>" id="imguser"  style="object-fit: cover;height: 300px;">
                        </div>
                        <div class="nk-block-head pt-3">
                            <div class="nk-block-head-content text-center">
                                <h4 class="title nk-block-title m-0"><?=html_entity_decode(stripslashes($data['nom'])).' '.html_entity_decode(stripslashes($data['prenom']))?></h4>
                                <div class="status text-center">
                                    <?php
                                    if($data['role'] == 1){
                                        ?>
                                        <span class="badge badge-dim badge-danger">Administrateur</span>
                                    <?php
                                    }else{
                                        ?>
                                        <span class="badge badge-dim badge-info">Editeur</span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <a href="javascript:void(0);"  class="btn btn-green-transparent mt-4  mb-5" id="btn-img"> <span class="load"><em class="fa fa-edit pr-1"></em></span> Modifier la photo de profil</a>
                            </div>

                            <form method="post" enctype="multipart/form-data" id="userImgForm">
                                <input type="file" name="userImg" id="userImg" style="display: none"/>
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

    //fonction vue image télécharger
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imguser').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#userImg').change(function(e){
        e.preventDefault();
        readURL(this);
        var value = document.getElementById('userImgForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/admin.photo.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            dataType: 'json',
            success: function(data){
                if(data.data_info == "ok"){
                    $('#imguser').attr('src', data.data_photo);
                }else {
                    swal("Action Impossible !", "Une erreur s\'est produite lors du traitement des données !", "error");
                }
            }
        });

    });


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

