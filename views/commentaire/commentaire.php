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
if($_SESSION['useraeek']['role'] == 4){
    header('location:'.$domaine_admin.'/can-2023');
    exit();
}
//add.categorie
//categorie.liste
//delete.categorie
//update.categorie
//require_once 'controller/add.categorie.php';
$rs = $comment->getAllComment();
$rsEnAt = $comment->getAllCommentEnAttente();
$rsValid = $comment->getAllCommentValider();
$rsr = $reponse->getAllReponses();

if($rsEnAts = $rsEnAt->fetch()){
    $comNbEn = $comment->nbCommentsEnAtt()->fetch();
    $nbsComtEnAtt =  $comNbEn['nb'];
}else{
    $nbsComtEnAtt = 0;
}
if($rsV = $rsValid->fetch()){
    $comNbValid = $comment->nbCommentsValid()->fetch();
    $nbsComtValider =  $comNbValid['nb'];
}else{
    $nbsComtValider = 0;
}
if($resl = $rs->fetch()){
    $comNb = $comment->nbComments()->fetch();
    $nbsComt =  $comNb['nb'];
}else{
    $nbsComt = 0;
}


if($reslr = $rsr->fetch()){
    $rpNb = $reponse->nbRepon()->fetch();
    $nbsR =  $rpNb['nb'];
}else{
    $nbsR = 0;
}
$nbTot = $nbsComt + $nbsR;
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php';
?>

<div class="main-content app-content mt-0">
<div class="side-app">

<div class="main-container container-fluid">
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
            <div class="card">
                <div class="row">
                    <div class="col-4">
                        <div class="circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class="fa fa-comment-o text-success fa-3x fs-30  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2"><?=$nbTot?></h2>
                            <h5 class="fw-normal mb-0">Commentaires</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
            <div class="card">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-warning align-items-center text-center box-warning-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class="fa fa-comment-o text-success fa-3x  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2"><?=$nbsComtEnAtt?></h2>
                            <h5 class="fw-normal mb-0"> En attente</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
            <div class="card">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute  circle-icon bg-success align-items-center text-center box-success-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class="fa fa-comment-o text-success fa-3x text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2"><?=$nbsComtValider?></h2>
                            <h5 class="fw-normal mb-0">Validé</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
            <div class="card">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-dark align-items-center text-center box-danger-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class=" fa fa-comment-o text-success fa-3x text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2"><?=$nbsR?></h2>
                            <h5 class="fw-normal mb-0">Réponses</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    <div class="row pt-5 mt-5" style="margin-right: 30px !important; margin-left: 0 !important;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="    border-bottom: 0 !important;">
                    <h3 class="card-title">Les commentaires</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tableComment">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date de création</th>
                                <th class="wd-15p">Auteur</th>
                                <th class="wd-15p">Réponse</th>
                                <th class="wd-15p">Statut</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--// Modal-->

<div class="modal fade" id="modalReponse">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Répondre à de : <span id="nomR"></span> </h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Commentaire : </p>
                    <p class="m-0 p-0" id="messageR"></p>
                </div>
            </div>
            <form method="post" id="comentReponseForm">
                <div class="modal-body">
                    <div class="succesR"></div>
                    <div class="errorR"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="reponse">Votre réponse<i class="required"></i> </label>
                        <textarea class="form-control" placeholder="Votre réponse" rows="5" name="reponses" id="reponses" required></textarea>
                        <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                        <input type="hidden" class="form-control" name="idCommentR" id="idCommentR">
                        <input type="hidden" class="form-control" name="art_id" id="art_id">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent"> <i class="load"></i> Valider votre réponse</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalUpdComment">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Commentaire de : <span id="nom"></span> </h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="comentsUpdForm">
                <div class="modal-body">
                    <div class="updSucces"></div>
                    <div class="updError"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="cat">Vous pouvez modifier le commentaire <i class="required"></i> </label>
                        <textarea class="form-control" placeholder="Message" rows="10" name="message" id="message" required></textarea>
                        <input type="hidden" class="form-control" name="formkeys" value="<?= $token ?>">
                        <input type="hidden" class="form-control" name="idComment" id="idComment">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent"> <i class="load"></i> Valider la modification</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
<?php
require_once 'layout/foot.php';
?>

<script>
    var tableComment;
    $(document).ready(function() {

        tableComment = $('#tableComment').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controle/commentaire.liste",
                "data":{
                    token:"<?=$token?>"
                }
            },
            "ordering": false,
            "pageLength": 10,
            "language" : {
                "sProcessing": "Traitement en cours ...",
                "sLengthMenu": "Afficher _MENU_ lignes",
                "sZeroRecords": "Aucun résultat trouvé",
                "sEmptyTable": "Aucune donnée disponible",
                "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                "sInfoEmpty": "Aucune ligne affichée",
                "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                "sInfoPostFix": "",
                "sSearch": "Chercher:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": '<span class="fa fa-circle-notch fa-spin"></span> Chargement...',
                "oPaginate" : {
                    "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
                },
                "oAria" : {
                    "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
                }
            }
        });

        $('#modalReponse').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var art_id = $(e.relatedTarget).data('art_id');
            var nom = $(e.relatedTarget).data('name');
            var message = $(e.relatedTarget).data('message');
            $('#idCommentR').val(rowid);
            $('#art_id').val(art_id);
            $('#nomR').html(nom);
            $('#messageR').html(message);
        });

        $('#modalUpdComment').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var nom = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('message');
            $('#idComment').val(rowid);
            $('#nom').html(nom);
            $('#message').val(description);
        });

        $('#comentsUpdForm').submit(function(e){
            e.preventDefault();
            $('.load').html('<i class="loader-btn"></i>');
            var values = document.getElementById('comentsUpdForm');
            var forms = new FormData(values);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controle/update.comment',
                data: forms,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                    alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableComment.ajax.reload(null,false);
                        $('.load').html('<i class=""></i>');
                        $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Commentaire modifié avec succès !</div>');
                    }else if(data.data_info == '1'){
                        $('.load').html('<i class=""></i>');
                        $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Commentaire validé avec succès !</div>');
                    }
                    else {
                        $('.updError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification du commentaire</div>');
                    }
                },
                error: function (error, ajaxOptions, thrownError) {
                    alert(error.responseText);
                }
            });
        });




        $('#comentReponseForm').submit(function(e){
            e.preventDefault();
            var value = document.getElementById('comentReponseForm');
            $('.load').html('<i class="loader-btn"></i>');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controle/save.reponse',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableComment.ajax.reload(null,false);
                        $('.load').html('');
                        $('#reponses').val('');
                        $('.succesR').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Votre réponse ajoutée avec succès !</div>');
                    }else {
                        $('#reponses').val('');
                        $('.errorR').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de l\'ajoiut de votre réponse</div>');
                    }
                },
                error: function (error, ajaxOptions, thrownError) {
                    alert(error.responseText);
                }
            });
        });




    });

    // supprimer
    function valider(id = null){
        if(id){
            swal({
                    title: "Voulez vous valider le commentaire ?",
                    text: "L'action va valider le commentaire sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, Valider",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/valid.comment', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableComment.ajax.reload(null,false);
                            }else{
                                swal("Impossible de valder le commentaire!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }
    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer le commentaire ?",
                    text: "L'action va supprimer le commentaire",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/delete.comment', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableComment.ajax.reload(null,false);
                            }else{
                                swal("Impossible de supprimer le commentaire!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

</script>