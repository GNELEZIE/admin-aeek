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


$nbTotalOui = $sortie->getNbrSortieByTpe('Oui')->fetch();
$nbTotalNon = $sortie->getNbrSortieByTpe('Non')->fetch();
$nbTotal = $sortie->getNbrSortie()->fetch();

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
                                    <h2 class="mb-0 number-font"><?=$nbTotalOui['nb']?></h2>
                                    <p class="text-white mb-0">Membres</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-secondary img-card box-secondary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"><?=$nbTotalNon['nb']?></h2>
                                    <p class="text-white mb-0">Autres</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card  bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"><?=$nbTotal['nb']?></h2>
                                    <p class="text-white mb-0">Total inscrit</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-users text-white fs-30 me-2 mt-2"></i> </div>
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
                    <h3 class="card-title">La liste des inscrits pour la sortie détente</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tableCandidat">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Nom & Prénom</th>
                                <th class="wd-15p">Numéro</th>
                                <th class="wd-15p">Membre</th>
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


<?php
require_once 'layout/foot.php';
?>

<script>
    var tableCandidat;
    $(document).ready(function() {

        tableCandidat = $('#tableCandidat').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controle/sortie.liste",
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

        var couverture = $('.couverture');
        var inputCouverture = $('.input-couverture');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileType = input.files[0]['type'];
                var valideImage = ["image/jpg","image/jpeg","image/png"];

                reader.onload = function (e) {
                    if($.inArray(fileType, valideImage) < 0){
                        $('.couverture').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
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



        $('#CandForm').submit(function(e){
            e.preventDefault();
            $('.loadCandidat').html('<i class="loader-btn"></i>');
            var value = document.getElementById('CandForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controle/candidat.save',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){

                    if(data.data_info == "ok"){
                        $('.loadCandidat').html('');
                        $('#nom').val('');
                        $('#prenom').val('');
                        $('#fonction').val('');
                        $('#bio').val('');
                        $('.file-msg').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
                        inputCouverture.val('');
                        inputCouverture.attr('src', '');
                        tableCandidat.ajax.reload(null,false);
                        swal("Le candidat a été ajouté avec succès!","", "success");
                    }else {
                        swal("Impossible d'ahouter le candidat!", "Une erreur s'est produite lors du traitement des données.", "error");
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
                        $.post('<?=$domaine_admin?>/controle/inscrit.delete', {id : id}, function (data) {
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