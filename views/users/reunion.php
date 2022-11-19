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
                <div class="row pt-5 mt-5" style="margin-right: 30px !important; margin-left: 0 !important;">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header" style="    border-bottom: 0 !important;">
                                <h3 class="card-title">La liste des inscrits pour la réunion</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap border-bottom" id="tableUsers">
                                        <thead>
                                        <tr class="border-bottom">
                                            <th class="wd-15p">Date de création</th>
                                            <th class="wd-15p">Nom & prénom</th>
                                            <th class="wd-15p">Téléphone</th>
                                            <th class="wd-15p">Ville</th>
                                            <th class="wd-15p">Email</th>
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
<?php
require_once 'layout/foot.php';
?>

<script>
    var tableUsers;

    $(document).ready(function() {

        tableUsers = $('#tableUsers').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/reunion.liste.php",
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







    });

    // supprimer
    function bloquer(id = null){
        if(id){
            swal({
                    title: "Voulez vous bloquer le membre ?",
                    text: "L'action va bloquer le membre sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, bloquer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/user.bloquer.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableUsers.ajax.reload(null,false);
                                $(".reloaded").load(location.href + " .reloaded");
                            }else{
                                swal("Impossible de bloquer le membre!", "Une erreur s'est produite lors du traitement des données.", "error");
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
                    title: "Voulez vous débloquer le membre ?",
                    text: "L'action va débloquer le membre sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, débloquer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/user.debloquer.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableUsers.ajax.reload(null,false);
                                $(".reloaded").load(location.href + " .reloaded");
                            }else{
                                swal("Impossible de débloquer le membre!", "Une erreur s'est produite lors du traitement des données.", "error");
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
                    title: "Voulez vous supprimer l'admin ?",
                    text: "L'action va supprimer l'admin",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/user.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableUsers.ajax.reload(null,false);
                            }else{
                                swal("Impossible de supprimer l'admin!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

</script>