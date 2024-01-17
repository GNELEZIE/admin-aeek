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
if($_SESSION['useraeek']['role'] == 4){
    header('location:'.$domaine_admin.'/can-2023');
    exit();
}

$artByUser = $article->getArticleByUserId($_SESSION['useraeek']['id_admin']);
$listeTags= $tag->getAllTag();
$listeCat = $categorie->getAllCategorie();
require_once 'controller/article.save.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;

require_once 'layout/head.php';
?>
<div class="container mt-5 main-content app-content mt-0" style="margin-left: 260px !important;">
    <div class="row mt-5 " style="margin-right: 30px !important; margin-left: 0 !important;">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ajouter un article</div>
                </div>
                <form method="post" id="addArticleForm" enctype="multipart/form-data">
                    <div class="card-body">
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
                        <div class="row mb-4">
                            <label for="categorie" class="col-md-3 form-label">Categories :</label>
                            <div class="">
                                <select name="categorie" id="categorie" class="form-control form-select select2 input-style" data-bs-placeholder="Select Country">
                                    <?php
                                    while($cat = $listeCat->fetch()) {

                                        ?>
                                        <option value="<?=$cat['id_categorie']?>"><?=$cat['nom']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="tags" class="col-md-3 form-label">Tags :</label>
                            <div class="form-group">
                                <select class="form-control select2" name="tags[]" id="tags" data-placeholder="Choisir un tag" multiple>
                                    <?php
                                    while($tgs = $listeTags->fetch()) {

                                        ?>
                                        <option value="<?=$tgs['id_tag']?>"><?=$tgs['nom']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row">
                            <label class="col-md-3 form-label mb-4">Description :</label>
                            <div class="mb-4">
                                <textarea class="content input-style" name="summernote" id="summernote" placeholder="Description"></textarea>
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
                        <button  class="btn btn-transparence-orange"> <i class="loader"></i> Publier l'article maintenant</button>
                    </div>
                </form>


            </div>
        </div>

    </div>
    </div>
<?php
require_once 'layout/foot.php';
?>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4'
        });
    });

    $('#addArticleForm').submit(function(e){
        $('.loader').html(' <i class="loader-btn text-white"></i> ');
    });

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




</script>