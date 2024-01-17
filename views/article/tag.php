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

if($_SESSION['useraeek']['role'] == 4){
    header('location:'.$domaine_admin.'/can-2023');
    exit();
}

//add.categorie
//categorie.liste
//delete.categorie
//update.categorie
//require_once 'controller/add.categorie.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php';
?>


<div class="main-content app-content mt-0">
<div class="side-app">
<div class="main-container container-fluid">
    <div class="row pt-5 mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="border-bottom: 0 !important;">
                    <h3 class="card-title">Les tags</h3>
                </div>
                <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                    <a href="#modalAddTag" class="btn-transparence-orange"  data-bs-effect="effect-sign" data-bs-toggle="modal"  style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter un tag</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tableTag">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date de création</th>
                                <th class="wd-15p">Nom</th>
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

<!--// Modal-->

<div class="modal fade" id="modalUpdTag">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Modifier le tag</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="tagUpdForm">
                <div class="modal-body">
                    <div class="updSucces"></div>
                    <div class="updError"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="cat">Catégorie <i class="required"></i> </label>
                        <input class="form-control" placeholder="Nom de la catégorie" type="text" name="udpTag" id="udpTag" required>
                        <input type="hidden" class="form-control" name="formkeys" value="<?= $token ?>">
                        <input type="hidden" class="form-control" name="idTag" id="idTag">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent"><i class="load"></i> Modifier le tag</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddTag">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Ajouter un tag</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="tagForm">
                <div class="modal-body">
                    <div class="succes"></div>
                    <div class="error"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="cat">Catégorie <i class="required"></i> </label>
                        <input class="form-control" placeholder="Nom du tag" type="text" name="tags" id="tags" required>
                        <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent"> <i class="load"></i> Ajouter un tag</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'layout/foot.php';
?>

<script>
    var tableTag;
    $(document).ready(function() {

        tableTag = $('#tableTag').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/tag.liste.php",
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

        $('#modalUpdTag').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var nom = $(e.relatedTarget).data('name');
            $('#idTag').val(rowid);
            $('#udpTag').val(nom);
        });

        $('#tagUpdForm').submit(function(e){
            e.preventDefault();
            $('.load').html('<i class="loader-btn"></i>');
            var value = document.getElementById('tagUpdForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/tag.update.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableTag.ajax.reload(null,false);
                        $('.load').html('');
                        $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Catégorie modifiée avec succès !</div>');
                    }else if(data.data_info == ''){

                    }
                    else {
                        $('.updError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification de la catégorie</div>');
                    }
                },
                error: function (error, ajaxOptions, thrownError) {
                    alert(error.responseText);
                }
            });
        });


        $('#tagForm').submit(function(e){
            e.preventDefault();
            $('.load').html('<i class="loader-btn"></i>');
            var value = document.getElementById('tagForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/tag.save.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableTag.ajax.reload(null,false);
                        $('.load').html('');
                        $('#tags').val('');
                        $('.succes').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Tag ajouté avec succès !</div>');
                    }else {
                        $('#tags').val('');
                        $('.error').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de l\'ajoiut du tag</div>');
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
                    title: "Voulez vous supprimer le tag ?",
                    text: "L'action va supprimer le tag sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/tag.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableTag.ajax.reload(null,false);
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