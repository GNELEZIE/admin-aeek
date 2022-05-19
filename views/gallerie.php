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
    <div class="row pt-5 mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="    border-bottom: 0 !important;">
                    <h3 class="card-title">Les evenements</h3>
                </div>
                <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                    <a href="#modalAddEvents" class="btn-transparence-orange"  data-bs-effect="effect-sign" data-bs-toggle="modal"  style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter un evenement</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap border-bottom" id="tableBannier">
                            <thead>
                            <tr class="border-bottom">
                                <th class="wd-15p">Date de création</th>
                                <th class="wd-15p">Nom</th>
                                <th class="wd-15p">Nombre de photo</th>
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
<div class="modal fade" id="modalAddEvents">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo p-5">
            <div class="modal-header" style="border-bottom: 0 !important;">
                <h3 class="modal-title">Ajouter un évènement</h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="catForm">
                <div class="modal-body">
                    <div class="succes"></div>
                    <div class="error"></div>
                </div>
                <div class="row row-sm">
                    <div class="form-group text-left pl-2">
                        <label for="nom">Nom de l'évènemente <i class="required"></i> </label>
                        <input class="form-control" placeholder="Nom de l'évènemente" type="nom" name="nom" id="nom" required>
                        <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                    </div>
                    <div class="form-group">
                        <label for="dateRdv" class="pb-1">Date du rendez-vous <i class="required"></i></label>
                        <input type="text" class="form-control style-input" name="dateRdv" id="dateRdv" placeholder="Date du rendez-vous" autocomplete="off" required>
                    </div>

                </div>
                <div class="modal-footer" style="border-top: 0 !important;">
                    <button class="btn btn-green-transparent">Ajouter un évènemente</button>
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
    var tableBannier;
    $(document).ready(function() {
        (function($){
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

        $('#dateRdv').datepicker({
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








        tableBannier = $('#tableBannier').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/banniere.liste.php",
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



        $('#bannierForm').submit(function(e){
            e.preventDefault();
            var value = document.getElementById('bannierForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/banniere.save.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                    alert(data.data_info);
                    if(data.data_info == "ok"){

                        tableBannier.ajax.reload(null,false);
                        $('.banSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">La bannière a été ajoutée avec succès !</div>');

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
                                tableBannier.ajax.reload(null,false);
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