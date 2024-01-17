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
$artByUser = $article->getArticleByUserId($_SESSION['useraeek']['id_admin']);
$listeTags= $tag->getAllTag();
$listeCat = $categorie->getAllCategorie();
require_once 'controller/emplois.save.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
if($_SESSION['useraeek']['role'] == 4){
    header('location:'.$domaine_admin.'/can-2023');
    exit();
}
require_once 'layout/head.php';
?>
<div class="container mt-5 main-content app-content mt-0" style="margin-left: 260px !important;">
    <div class="row mt-5 " style="margin-right: 30px !important; margin-left: 0 !important;">
        <div class="col-md-8 offset-2 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ajouter une offre externe</div>
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
                            <label class="col-md-3 form-label">Nom de l'offre</label>
                            <div class="">
                                <input type="text" class="form-control input-style" name="nom" id="nom" placeholder="Nom de l'offre" required>
                                <input type="hidden" class="form-control " name="formkey" value="<?=$token?>">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-md-3 form-label">Lien des détailles</label>
                            <div class="">
                                <input type="url" class="form-control input-style" name="lien" id="lien" placeholder="Lien des détailles" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                           <div class="col-md-6">
                               <label for="debut" class="col-md-3 form-label">Début</label>
                               <div class="">
                                   <input type="text" class="form-control input-style" name="dateDebut" id="dateDebut" placeholder="Date de début" required>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <label for="fin" class="col-md-3 form-label">Fin</label>
                               <div class="">
                                   <input type="text" class="form-control input-style" name="dateFin" id="dateFin" placeholder="Date de fin" required>
                               </div>
                           </div>
                        </div>
                        <div class="row mb-4">
                            <label for="categorie" class="col-md-3 form-label">Type de l'offre</label>
                            <div class="">
                                <select name="categorie" id="categorie" class="form-control select2 form-select input-style">
                                    <option value="1">PAE</option>
                                    <option value="2">CDD</option>
                                    <option value="3">CDI</option>
                                    <option value="4">Stage école</option>
                                    <option value="5">CTT</option>
                                    <option value="6">Frulence</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 form-label mb-4">Description</label>
                            <div class="mb-4">
                                <textarea class="form-control input-style" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="py-3">
                                <p>Photo de logo (format accepté: jpg, png, jpeg) <i class="required"></i></p>
                            </div>
                            <div class="form-label-group logo" id="test">
                                    <span class="file-msg">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>
                                        Cliquez ou glissez déposez la photo de logo
                                          </span>
                                <input type="file" class="file-input input-logo" name="logo" id="logo" accept=".png, .jpg, .jpeg" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button  class="btn btn-transparence-orange"> <i class="loader"></i> Publier l'offre maintenant</button>
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
        (function ($) {
            $.fn.datepicker.dates['fr'] = {
                days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                daysShort: ["Dim.", "Lun.", "Mar.", "Mer.", "Jeu.", "Ven.", "Sam."],
                daysMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                monthsShort: ["Janv.", "Févr.", "Mars", "Avril", "Mai", "Juin", "Juil.", "Août", "Sept.", "Oct.", "Nov.", "Déc."],
                today: "Aujourd'hui",
                monthsTitle: "Mois",
                clear: "Effacer",
                weekStart: 1,
                format: "dd/mm/yyyy"
            };
        }(jQuery));
        $('#dateDebut').datepicker({
            language: 'fr',
            orientation: 'bottom',
            autoclose: true,
            assumeNearbyYear: true,
            showOnFocus: true,
            format: 'dd/mm/yyyy',
            weekStart: 1,
            todayHighlight: true,
            defaultViewDate: 'today'
        });
        $('#dateFin').datepicker({
            language: 'fr',
            orientation: 'bottom',
            autoclose: true,
            assumeNearbyYear: true,
            showOnFocus: true,
            format: 'dd/mm/yyyy',
            weekStart: 1,
            todayHighlight: true,
            defaultViewDate: 'today'
        });
    });

    $('#addArticleForm').submit(function(e){
        $('.loader').html(' <i class="loader-btn text-white"></i> ');
    });

    var logo = $('.logo');
    var inputlogo = $('.input-logo');

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var fileType = input.files[0]['type'];
            var valideImage = ["image/jpg","image/jpeg","image/png"];

            reader.onload = function (e) {
                if($.inArray(fileType, valideImage) < 0){
                    $('.file-msg').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de logo');
                    inputlogo.val('');
                    inputlogo.attr('src', '');
                    swal("Oups format non autorisé !","Les formats acceptés sont : jpg, jpeg et png !","error");
                }else{
                    logo.css('background-image', 'url('+e.target.result+')');
                }

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    inputlogo.on('dragenter focus click', function() {
        logo.addClass('is-active');
    });

    inputlogo.on('dragleave blur drop', function() {
        logo.removeClass('is-active');
    });

    inputlogo.on('change', function() {

        var filesCount = $(this)[0].files.length;
        var textContainer = $(this).prev();
        if (filesCount === 1) {
            var fileName = $(this).val().split('\\').pop();
            textContainer.text(fileName);
        } else {
            textContainer.html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de logo');
        }
        readURL(this);
    });




</script>