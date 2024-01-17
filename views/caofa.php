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
$nbTotal = $sortie->getNbrCaofa()->fetch();

$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php';
?>

<div class="main-content app-content mt-0">
<div class="side-app">

<div class="main-container container-fluid">
<div class="container mt-5">
    <div class="row pt-5 mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"><?=$nbTotal['nb']?></h2>
                                    <p class="text-white mb-0">Candidates</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="border-bottom: 0 !important;">
                    <h1 class="card-title">La liste des inscrits</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tableCandidat">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Nom & Prénom</th>
                                <th class="wd-15p">Numéro</th>
                                <th class="wd-15p">Niveau</th>
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
<div class="modal fade" id="modalCaofa">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title"> <span id="nom"></span> ( <span id="niveau"></span>) </h3>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="m-0 p-0" id="message"></p>
            </div>

            <div class="modal-footer" style="border-top: 0 !important;">
                <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Fermer</a>
            </div>

        </div>
    </div>
</div>

<?php
require_once 'layout/foot.php';
?>

<script>
    var tableCandidat;
    $(document).ready(function() {

        $('#modalCaofa').on('show.bs.modal', function (e) {

            var rowid = $(e.relatedTarget).data('id');
            var nom = $(e.relatedTarget).data('nom');
            var niveau = $(e.relatedTarget).data('niveau');
            var message = $(e.relatedTarget).data('message');

            $('#niveau').html(niveau);
            $('#nom').html(nom);
            $('#message').html(message);
        });

        tableCandidat = $('#tableCandidat').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controle/caofa.liste",
                "data":{
                    token:"<?=$token?>"
                }
            },
            dom: 'Bfrtip',
            buttons: [
            'excel', 'pdf'
        ],
            "ordering": false,
            "pageLength": 50,
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



    });

    // supprimer
    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer cette personne ?",
                    text: "L'action va supprimer la personne sélectionnée",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/caofa.delete', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Suppression effectuée avec succès!","", "success");
                                tableCandidat.ajax.reload(null,false);
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