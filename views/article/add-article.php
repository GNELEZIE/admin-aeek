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
                        <div class="row mb-4">
                            <label class="col-md-3 form-label">Titre de l'article :</label>
                            <div class="">
                                <input type="text" class="form-control" name="titre" id="titre" required>
                                <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-md-3 form-label">Categories :</label>
                            <div class="">
                                <select name="categorie" id="categorie" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                    <option value="1">Technology</option>
                                    <option value="2">Travel</option>
                                    <option value="3">Food</option>
                                    <option value="4">Fashion</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row">
                            <label class="col-md-3 form-label mb-4">Description :</label>
                            <div class="mb-4">
                                <textarea class="content" name="summernote" id="summernote"></textarea>
                            </div>
                        </div>
                        <!--End Row-->

                        <div class="form-group mb-0">
                            <label class="col-md-3 form-label mb-4">Couverture:</label>
                            <input id="demo" type="file" name="couverture" accept=".jpg, .png, jpeg">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button href="javascript:void(0)" class="btn btn-primary">Publier</button>
                        <a href="javascript:void(0)" class="btn btn-default float-end">Discard</a>
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
    $('#addArticleForm').submit(function(e){
        e.preventDefault();
        var value = document.getElementById('addArticleForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/article.save.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            dataType: 'json',
            success: function(data){
                alert(data.data_info);
                if(data.data_info == "ok"){
                    swal("Opération effectuée avec succès!","", "success");
//                    $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Catégorie modifiée avec succès !</div>');
                }else if(data.data_info == '1'){
                    swal("Impossible de publier l'article!", "Une erreur s'est produite lors du traitement des données.", "error");
                }
                else {
                    swal("Impossible de supprimer!", "Une erreur s'est produite lors du traitement des données.", "error");
//                    $('.updError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification de la catégorie</div>');
                }
            },
            error: function (error, ajaxOptions, thrownError) {
                alert(error.responseText);
            }
        });
    });
</script>