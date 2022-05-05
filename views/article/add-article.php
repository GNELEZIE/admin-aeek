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
$listeCat = $categorie->getAllCategorie();
require_once 'controller/article.save.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;

require_once 'layout/header.php';
?>

    <div class="row mt-5 pt-5">
        <div class="col-xl-8">
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
                            <label class="col-md-3 form-label">Categories :</label>
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
                        <button  class="btn btn-primary"> <i class="loader"></i> Publier l'article maintenant</button>
                    </div>
                </form>


            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Article recents</div>
                </div>
                <div class="card-body">
                    <div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div><div class="d-flex overflow-visible pb-2 pt-2" style="border-bottom: 1px solid #e9edf4;">
                        <a href="blog-details.html" class="card-aside-column br-5 cover-image" data-bs-image-src="<?=$asset?>/images/media/19.jpg" style="background: url(&quot;../assets/images/media/19.jpg&quot;) center top; height: 75px"></a>
                        <div class="ps-3 flex-column">
                            <span class="badge bg-danger me-1 mb-1 mt-1">Lifestyle</span>
                            <h6><a href="#" class="mb-0">Generator on the Internet..</a></h6>
                            <small>12/05/2022</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'layout/footer.php';
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

//    $('#addArticleForm').submit(function(e){
//        e.preventDefault();
//        var value = document.getElementById('addArticleForm');
//        var form = new FormData(value);
//        $('.loader').html(' <i class="loader-btn text-white"></i> ');
//        $.ajax({
//            method: 'post',
//            url: '<?//=$domaine_admin?>///controller/article.save.php',
//            data: form,
//            contentType:false,
//            cache:false,
//            processData:false,
//            dataType: 'json',
//            success: function(data){
////                alert(data.data_info);
//                if(data.data_info == "ok"){
//                    $('.loader').html('');
//                    swal("Opération effectuée avec succès!","", "success");
////                    $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Catégorie modifiée avec succès !</div>');  couvertureInput.val('');
//                    $('#summernote').val('');
//                    $('#titre').val('');
//                    $('#categorie').val('');
//                    couvertureInput.attr('src', '');
//                    $('.file-msg').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
//
//
//                }else if(data.data_info == '1'){
//                    $('.loader').html('');
//                    swal("Impossible de publier l'article!", "Une erreur s'est produite lors du traitement des données.", "error");
//                }
//                else {
//                    $('.loader').html('');
//                    swal("Impossible de supprimer!", "Une erreur s'est produite lors du traitement des données.", "error");
////                    $('.updError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification de la catégorie</div>');
//                }
//            },
//            error: function (error, ajaxOptions, thrownError) {
//                alert(error.responseText);
//            }
//        });
//    });


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