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
                    <h3 class="card-title">Les offres d'emplois</h3>
                </div>
                <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                    <a href="#modalAddCat" class="btn-transparence-orange"  data-bs-effect="effect-sign" data-bs-toggle="modal"  style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter une offre</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="TableEmplois">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date de création</th>
                                <th class="wd-15p">Titre</th>
                                <th class="wd-15p">Expire le</th>
                                <th class="wd-15p">Type contrat</th>
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
</div>
</div>

<!--// Modal-->


<div class="modal fade" id="modalAddCat">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Ajouter une bannière</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
                <form method="post" id="bannierForm" enctype="multipart/form-data">
                    <div class="card-body p-0">
                        <div class="banSucces"></div>
                        <div class="banError"></div>
                        <div class="row">

                            <div class="form-group">
                                <label for="titre" class="form-label">Nom de l'offre</label>
                                <input type="text" class="form-control input-style" name="titre" id="titre" placeholder="Nom de l'offre" required>
                                <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                            </div>
                            <div class="form-group">
                                <label for="sous_titre" class="form-label">Sous Titre </label>
                                <input type="text" class="form-control input-style" name="sous_titre" id="sous_titre" placeholder="Sous titre" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
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
                        <button  class="btn btn-transparence-orange"> <i class="loader"></i> <i class="load"></i> Ajouter la bannière</button>
                    </div>
                </form>

        </div>
    </div>
</div>

<?php
require_once 'layout/foot.php';
?>

<script>
    var TableEmplois;
    $(document).ready(function() {

        TableEmplois = $('#TableEmplois').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/emplois.liste.php",
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




    });

    function bloquer(id = null){
        if(id){
            swal({
                    title: "Voulez vous bloquer l'offre ?",
                    text: "L'action va bloquer l'offre sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, bloquer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/emploi.bloquer.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                TableEmplois.ajax.reload(null,false);
                                $(".reloaded").load(location.href + " .reloaded");
                            }else{
                                swal("Impossible de bloquer l'offre!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

    function debloquer(id = null){
        if(id){
            swal({
                    title: "Voulez vous débloquer l'offre ?",
                    text: "L'action va débloquer l'offre sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, débloquer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/emplois.debloquer.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                TableEmplois.ajax.reload(null,false);
                                $(".reloaded").load(location.href + " .reloaded");
                            }else{
                                swal("Impossible de débloquer l'offre!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

    // supprimer
    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer l'offre ?",
                    text: "L'action va supprimer l'offre sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/emplois.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                TableEmplois.ajax.reload(null,false);
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