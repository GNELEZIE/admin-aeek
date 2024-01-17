<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeek'])){
    header('location:'.$domaine_admin.'/connexion');
    exit();
}

$nbArticle = $article->getAllNbrArticleByUser($_SESSION['useraeek']['id_admin'])->fetch();

$comm = $article->getAllNbrArticleByUserAndComment($_SESSION['useraeek']['id_admin'])->fetch();

$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php'
?>
<!--app-content open-->
<div class="main-content app-content p-0-mobile app-content mt-0 ml-0-mobile">
    <div class="side-app">

        <div class="main-container container-fluid">
            <div class="row pt-5 mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <!-- COL END -->
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-50-mobile">
                            <div class="card  bg-success img-card box-success-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?=$nbArticle['nb']?></h2>
                                            <p class="text-white mb-0">Articles</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COL END -->
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-50-mobile">
                            <div class="card bg-info img-card box-info-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?=$comm['nb']?></h2>
                                            <p class="text-white mb-0">Commentaire</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12 p-0-mobile">
                    <div class="card">
                        <div class="p-3 pb-5">
                            <div class="w100">
                                <h2 class="text-bold">La liste des artciles</h2>
                            </div>
                            <div class="card-btn pl-3">
                                <a href="<?=$domaine_admin?>/can-article" class="btn-transparence-orange" style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter un article</a>
                            </div>
                        </div>


                        <div class="card-body pb-0 p-5-mobile" id="here">
                            <ul class="task-list">
                                <?php
                                $com1 = $article->getArticleByUserId($_SESSION['useraeek']['id_admin']);
                                $com = $article->getArticleByUserId($_SESSION['useraeek']['id_admin']);
                                while($articleData = $com->fetch()){
                                    ?>

                                    <li class="d-sm-flex">
                                        <div>
                                            <i class="task-icon bg-warning"></i>
                                            <h6 class="fw-semibold"><?=reduit_text(html_entity_decode(stripslashes($articleData['titre'])),'40')?><span
                                                    class="text-muted fs-11 mx-2 fw-normal"><?=date_fr($articleData['date_article'])?></span>
                                            </h6>
                                            <p class="text-muted fs-12"><?=reduit_text(html_entity_decode(stripslashes($articleData['description'])),'40')?>
                                                <a href="<?=$domaine?>/blog/<?=$articleData['slug']?>" class="fw-semibold" target="_blank"> Voir l'article</a></p>
                                        </div>
                                        <div class="ms-auto d-md-flex">

                                            <a href="<?=$domaine_admin?>/can-article/<?=$articleData['slug']?>" class=""  data-id="<?=$articleData['id_article']?>">
                                                <span class="fe fe-edit pbtn"> Modifier </span>
                                            </a>
                                        </div>
                                    </li>
                                <?php
                                }

                                if($comss = $com1->fetch()){

                                }else{
                                    ?>
                                    <div class="alert alert-info mb-5">
                                        Vous n'avez pas encore publié un article !!!!
                                    </div>
                                <?php
                                }

                                ?>


                            </ul>
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

