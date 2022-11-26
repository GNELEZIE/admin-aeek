<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeek'])){
    header('location:'.$domaine_admin.'/login');
    exit();
}
require_once 'controller/candidat.update.php';
if(isset($doc[1]) and !isset($doc[2])) {
    $liste = $candidat->getCandidatBySlug($doc[1]);

    if ($candData = $liste->fetch()) {

    }else {
        header('location:' . $domaine_admin . '/error');
        exit();
    }
}else{
    header('location:' . $domaine_admin . '/error');
    exit();
}

$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php';
?>

<div class="main-content app-content mt-0">
<div class="side-app">
<div class="main-container container-fluid">
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header" style="border-bottom: 0 !important;">
                    <h3 class="card-title">Modification</h3>
                </div>

                <div class="card-body">
                    <form method="post" id="CandUpdForm">
                        <?php if(!empty($errors)){ ?>
                            <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                <?php foreach($errors as $error){ ?>
                                    <?php echo $error ?>
                                <?php }?>
                            </div>
                        <?php }?>
                        <?php if(!empty($success)){ ?>
                            <div class="alert alert-success" style="font-size: 14px" role="alert">
                                <?php foreach($success as $succes){ ?>
                                    <?php echo $succes ?>
                                <?php }?>
                            </div>
                        <?php }?>
                        <div class="card-body p-0">
                            <div class="banSucces"></div>
                            <div class="banError"></div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control input-style" name="nom" id="nom" value="<?=html_entity_decode(stripslashes($candData['nom']))?>">
                                    <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                                    <input type="hidden" class="form-control " name="cand" value="<?=$candData['id_candidat']?>">
                                </div>
                                <div class="form-group">
                                    <label for="prenom" class="form-label">Prenom </label>
                                    <input type="text" class="form-control input-style" name="prenom" id="prenom" value="<?=html_entity_decode(stripslashes($candData['prenom']))?>">
                                </div>
                                <div class="form-group">
                                    <label for="fonction" class="form-label">Fonction </label>
                                    <input type="text" class="form-control input-style" name="fonction" id="fonction" value="<?=html_entity_decode(stripslashes($candData['fonction']))?>">
                                </div>
                                <div class="form-group">
                                    <label for="bio" class="form-label">Biographie </label>
                                    <textarea   class="form-control input-style" name="bio" id="bio"><?=html_entity_decode(stripslashes($candData['bio']))?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button  class="btn btn-transparence-orange"> <i class="loader"></i> <i class="loadUpdCandidat"></i> Modifier le candidat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="CandForm" enctype="multipart/form-data">

                    </form>
                </div>
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

    $(document).ready(function() {


        var couverture = $('.couverture');
        var inputCouverture = $('.input-couverture');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileType = input.files[0]['type'];
                var valideImage = ["image/jpg","image/jpeg","image/png"];

                reader.onload = function (e) {
                    if($.inArray(fileType, valideImage) < 0){
                        $('.couverture').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
                        inputCouverture.val('');
                        inputCouverture.attr('src', '');
                        swal("Oups format non autorisé !","Les formats acceptés sont : jpg, jpeg et png !","error");
                    }else{
                        couverture.css('background-image', 'url('+e.target.result+')');
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        inputCouverture.on('dragenter focus click', function() {
            couverture.addClass('is-active');
        });

        inputCouverture.on('dragleave blur drop', function() {
            couverture.removeClass('is-active');
        });

        inputCouverture.on('change', function() {

            var filesCount = $(this)[0].files.length;
            var textContainer = $(this).prev();
            if (filesCount === 1) {
                var fileName = $(this).val().split('\\').pop();
                textContainer.text(fileName);
            } else {
                textContainer.html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
            }
            readURL(this);
        });



        $('#CandUpdForm').submit(function(e){
            $('.loadUpdCandidat').html('<i class="loader-btn"></i>');
    });



</script>