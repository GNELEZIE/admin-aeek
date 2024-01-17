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
require_once 'controller/can-article.update.php';
if(isset($doc[1]) and !isset($doc[2])){
    $art = $article->getArticleBySlug($doc[1]);
    if($artData = $art->fetch()){

    }else{
        header('location:'.$domaine_admin.'/error');
        exit();
    }
}

require_once 'controller/can-article.save.php';



$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;

require_once 'layout/head.php';
?>
<div class="container mt-5 main-content p-0-mobile app-content mt-0 ml-0-mobile">
    <div class="row mt-5 mr-0-mobile" style="margin-right: 30px; margin-left: 0 !important;">
        <div class="col-xl-12">
            <?php
            if(isset($doc[0]) and !isset($doc[1])){
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ajouter un article</div>
                    </div>
                    <form method="post" id="addArticleForm" enctype="multipart/form-data">
                        <div class="card-body p-10-mobile">
                            <?php if (!empty($success)) { ?>
                                <div class="alert alert-success" style="font-size: 14px" role="alert">
                                    <?php foreach ($success as $succ) { ?>
                                        <?php echo $succ ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($errors)) { ?>
                                <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                    <?php foreach ($errors as $error) { ?>
                                        <?php echo $error ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Titre de l'article :</label>
                                <div class="">
                                    <input type="text" class="form-control input-style" name="titre" id="titre" placeholder="Titre de l'article" required>
                                    <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                                </div>
                            </div>
                            <!-- Row -->
                            <div class="row">
                                <label class="col-md-3 form-label mb-4">Description :</label>
                                <div class="mb-4">
                                    <textarea class="form-control input-style" name="description" id="description" rows="7" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <!--End Row-->
                            <div class="form-group">
                                <div class="py-3">
                                    <p>Photo de couverture (format accepté: jpg, png, jpeg) <i class="required"></i></p>
                                </div>
                                <div class="form-label-group couverture" id="test">
                                    <span class="file-msg">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>
                                        Cliquez ou glissez déposez la photo de couverture
                                          </span>
                                    <input type="file" class="file-input input-couverture" name="couverture" id="couverture" accept=".png, .jpg, .jpeg" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button  class="btn btn-green-transparent"> <i class="loader"></i> Publier l'article maintenant</button>
                        </div>
                    </form>

                </div>
            <?php
            }elseif(isset($doc[1]) and !isset($doc[2])){
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Modifier l'article</div>
                    </div>
                    <form method="post" id="updArticleCANForm">
                        <div class="card-body p-10-mobile">
                            <?php if (!empty($succes)) { ?>
                                <div class="alert alert-success" style="font-size: 14px" role="alert">
                                    <?php foreach ($succes as $suc) { ?>
                                        <?php echo $suc ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($errors)) { ?>
                                <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                    <?php foreach ($errors as $error) { ?>
                                        <?php echo $error ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Titre de l'article :</label>
                                <div class="">
                                    <input type="text" class="form-control input-style" name="titreudp" id="titreudp" value="<?=html_entity_decode(stripslashes($artData['titre']))?>" required>
                                    <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                                </div>
                            </div>

                            <!-- Row -->
                            <div class="row">
                                <label class="col-md-3 form-label mb-4">Description :</label>
                                <div class="mb-4">
                                    <textarea class="form-control input-style" name="descriptionudp" id="descriptionudp" rows="7" required><?=html_entity_decode(stripslashes($artData['description']))?></textarea>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                        <div class="card-footer text-center">
                            <input type="hidden" name="artIds" value="<?=html_entity_decode(stripslashes($artData['id_article']))?>"/>
                            <button  class="btn btn-green-transparent" type="submit"> <i class="loader"></i> Modifier l'article maintenant</button>
                        </div>
                    </form>

                </div>
            <?php
            }else{

            }
            ?>
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
                        $('.file-msg').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
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



    });

    $('#addArticleForm').submit(function(e){
        $('.loader').html(' <i class="loader-btn text-white"></i> ');
    });


</script>