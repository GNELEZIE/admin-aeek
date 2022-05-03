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
require_once 'layout/header.php';
?>

    <div class="row mt-5 pt-5">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ajouter un article</div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Titre de l'article :</label>
                        <div class="">
                            <input type="text" class="form-control" value="Typing.....">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Categories :</label>
                        <div class="">
                            <select name="country" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                <option value="br">Technology</option>
                                <option value="cz">Travel</option>
                                <option value="de">Food</option>
                                <option value="pl">Fashion</option>
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
                        <label class="col-md-3 form-label mb-4">Ajouter une photo de couverture:</label>
                        <input id="demo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="javascript:void(0)" class="btn btn-primary">Publier</a>
                    <a href="javascript:void(0)" class="btn btn-default float-end">Discard</a>
                </div>
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