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
require_once 'layout/head.php';
?>

<div class="main-content app-content mt-0">
<div class="side-app">

<div class="main-container container-fluid">
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="    border-bottom: 0 !important;">
                    <h3 class="card-title">Page à propos</h3>
                </div>
                <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                    <a href="#modalAddPropos" class="btn-transparence-orange"  data-bs-effect="effect-sign" data-bs-toggle="modal"  style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter une information</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tablePropos">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date de création</th>
                                <th class="wd-15p">Titre</th>
                                <th class="wd-15p">Sous titre</th>
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
</div>
</div>

<!--// Modal-->


<div class="modal fade" id="modalAddPropos">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Ajouter une information</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
                <form method="post" id="proposForm" enctype="multipart/form-data">
                    <div class="card-body p-0">
                        <div class="banSucces"></div>
                        <div class="banError"></div>
                        <div class="row">
                            <div class="form-group">
                                <label for="titre" class="form-label">Titre </label>
                                <input type="text" class="form-control input-style" name="titre" id="titre" placeholder="Titre">
                                <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                            </div>
                            <div class="form-group">
                                <label for="sous_titre" class="form-label">Sous Titre </label>
                                <input type="text" class="form-control input-style" name="sous_titre" id="sous_titre" placeholder="Sous titre">
                            </div>
                            <div class="form-group">
                                <label for="sous_titre" class="form-label">Description</label>
                                <textarea  class="form-control input-style" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <p>Photo de couverture (format accepté: jpg, png, jpeg) <i class="required"></i></p>
                            </div>
                            <div class="lod">
                                <div class="form-label-group couverture" id="test">
                                    <span class="file-msg">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>
                                        Cliquez ou glissez déposez la photo de couverture
                                          </span>
                                    <input type="file" class="file-input input-couverture" name="couverture" id="couverture" accept=".png, .jpg, .jpeg" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button  class="btn btn-transparence-orange"> <i class="loader"></i> <i class="load"></i> Ajouter maintenant</button>
                    </div>
                </form>

        </div>
    </div>
</div>








<div class="modal fade" id="modalUpdPropos">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Modifier l'information</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
                <form method="post" id="proposPhotoUpdForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="lod">
                            <div class="form-label-group couverture" id="test">
                                    <span class="file-msg">
                                        <img src="" class="imgChange" alt=""/>
                                    </span>
                                <input type="hidden" class="form-control " name="idPropos"">
                                <input type="file" class="file-input input-couverture" name="couverture" id="couverture" accept=".png, .jpg, .jpeg" required>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="proposUpdForm" enctype="multipart/form-data">
                    <div class="card-body p-0">
                        <div class="SuccesUpd"></div>
                        <div class="ErrorUpd"></div>
                        <div class="row">
                            <div class="form-group">
                                <label for="titre" class="form-label">Titre </label>
                                <input type="text" class="form-control input-style" name="titres" id="titres" placeholder="Titre">
                                <input type="hidden" class="form-control " name="formkeys" value="<?= $token ?>">
                                <input type="hidden" class="form-control " name="idProp" id="idProp">
                                <input type="hidden" class="form-control " name="pho" id="pho">
                            </div>
                            <div class="form-group">
                                <label for="sous_titre" class="form-label">Sous Titre </label>
                                <input type="text" class="form-control input-style" name="sous_titres" id="sous_titres" placeholder="Sous titre">
                            </div>
                            <div class="form-group">
                                <label for="sous_titre" class="form-label">Description</label>
                                <textarea  class="form-control input-style" name="descriptions" id="descriptions" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button  class="btn btn-transparence-orange"> <i class="loader"></i> <i class="load"></i> Ajouter maintenant</button>
                    </div>
                </form>

        </div>
    </div>
</div>

<?php
require_once 'layout/foot.php';
?>

<script>
    var tablePropos;
    $(document).ready(function() {

        tablePropos = $('#tablePropos').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/propos.liste.php",
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

        $('#modalUpdPropos').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var titre = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');
            var sous_titre = $(e.relatedTarget).data('sous');
            var photo = $(e.relatedTarget).data('image');
            $('#idProp').val(rowid);
            $('#idPropos').val(rowid);
            $('#titres').val(titre);
            $('#sous_titres').val(sous_titre);
            $('#descriptions').val(description);
            $('.imgChange').attr('src', photo);
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

        $('#couverture').change(function(e){
            e.preventDefault();
            readURL(this);
            var value = document.getElementById('proposPhotoUpdForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/propos.photo.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
                  alert(data.data_info);
                    if(data.data_info == "ok"){
                        $('.imgChange').attr('src', data.data_photo);
                    }else {
                        swal("Action Impossible !", "Une erreur s\'est produite lors du traitement des données !", "error");
                    }
                }
            });

        });
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



        $('#proposUpdForm').submit(function(e){
            e.preventDefault();
            $('.load').html('<i class="loader-btn"></i>');
            var value = document.getElementById('proposUpdForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/propos-update.save.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                    alert(data.data_info);
                    if(data.data_info == "ok"){
                        $('.load').html('');
                        tablePropos.ajax.reload(null,false);
                        $('.SuccesUpd').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Les informations ont été modifiée avec succès !</div>');
                    }else {
                        $('.ErrorUpd').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification des informations</div>');
                    }
                },
                error: function (error, ajaxOptions, thrownError) {
                    alert(error.responseText);
                }
            });
        });


        $('#proposForm').submit(function(e){
            e.preventDefault();
            $('.load').html('<i class="loader-btn"></i>');
            var value = document.getElementById('proposForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/propos.save.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                    alert(data.data_info);
                    if(data.data_info == "ok"){
                        $('.load').html('');
                        $('#description').val('');
                        $('#sous_titre').val('');
                        $('#titre').val('');
                        $('#couverture').val('');
                        tablePropos.ajax.reload(null,false);
                        $('.banSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">La bannière a été ajoutée avec succès !</div>');
                         $('.lod').html('<div class="form-label-group couverture" id="test"> <span class="file-msg"> <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/> Cliquez ou glissez déposez la photo de couverture </span> <input type="file" class="file-input input-couverture" name="couverture" id="couverture" accept=".png, .jpg, .jpeg" required> </div>');
                    }else {
                        $('.banError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification de la catégorie</div>');
                    }
                },
                error: function (error, ajaxOptions, thrownError) {
                    alert(error.responseText);
                }
            });
        });




    });

    // supprimer
    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer la bannière ?",
                    text: "L'action va supprimer la bannière sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/banniere.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tablePropos.ajax.reload(null,false);
                            }else{
                                swal("Impossible de supprimer!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

</script>