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
//add.categorie
//categorie.liste
//delete.categorie
//update.categorie
//require_once 'controller/add.categorie.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/header.php';
?>


<div class="container pt-5 mt-5">
    <div class="row">

        <!-- COL END -->

        <!-- COL END -->

        <!-- COL END -->
        
        <!-- COL END -->
        <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
            <div class="card">
                <div class="row">
                    <div class="col-4">
                        <div class="circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2">9,678</h2>
                            <h5 class="fw-normal mb-0">Total Requests</h5>
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
                        <div class="card-img-absolute circle-icon bg-secondary align-items-center text-center box-secondary-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class="lnr lnr-briefcase fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2">10,257</h2>
                            <h5 class="fw-normal mb-0">Total Revenue</h5>
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
                            <i class="lnr lnr-gift fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2">$67,953</h2>
                            <h5 class="fw-normal mb-0">Total Profit</h5>
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
                        <div class="card-img-absolute circle-icon bg-danger align-items-center text-center box-danger-shadow bradius">
                            <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                            <i class=" lnr lnr-cart fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-2 fw-normal mt-2">7,632</h2>
                            <h5 class="fw-normal mb-0">Total Sales</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    <div class="row pt-5 mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="    border-bottom: 0 !important;">
                    <h3 class="card-title">Les commentaires</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tableCat">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date de création</th>
                                <th class="wd-15p">Auteur</th>
                                <th class="wd-15p">Message</th>
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


<!--// Modal-->

<div class="modal fade" id="modalUpdCat">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Modifier la catégorie</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="catUpdForm">
                <div class="modal-body">
                    <div class="updSucces"></div>
                    <div class="updError"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="cat">Catégorie <i class="required"></i> </label>
                        <input class="form-control" placeholder="Nom de la catégorie" type="text" name="udpCat" id="udpCat" required>
                        <input type="hidden" class="form-control" name="formkeys" value="<?= $token ?>">
                        <input type="hidden" class="form-control" name="idCat" id="idCat">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent">Ajouter une catégorie</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddCat">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Ajouter une catégorie</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="catForm">
                <div class="modal-body">
                    <div class="succes"></div>
                    <div class="error"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="cat">Catégorie <i class="required"></i> </label>
                        <input class="form-control" placeholder="Nom de la catégorie" type="text" name="cat" id="cat" required>
                        <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent">Ajouter une catégorie</button>
                    <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'layout/footer.php';
?>

<script>
    var tableCat;
    $(document).ready(function() {

        tableCat = $('#tableCat').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/commentaire.liste.php",
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

        $('#modalUpdCat').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var nom = $(e.relatedTarget).data('name');
            $('#idCat').val(rowid);
            $('#udpCat').val(nom);
        });

        $('#catUpdForm').submit(function(e){
            e.preventDefault();
            var value = document.getElementById('catUpdForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/update.categorie.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
                    alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableCat.ajax.reload(null,false);
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
        $('#catForm').submit(function(e){
            e.preventDefault();
            var value = document.getElementById('catForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/add.categorie.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableCat.ajax.reload(null,false);
                        $('#cat').val('');
                        $('.succes').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Catégorie ajoutée avec succès !</div>');
                    }else {
                        $('#cat').val('');
                        $('.error').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de l\'ajoiut de la catégorie</div>');
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
                    title: "Voulez vous supprimer la catégorie ?",
                    text: "L'action va supprimer le catégorie sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/delete.categorie.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableCat.ajax.reload(null,false);
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