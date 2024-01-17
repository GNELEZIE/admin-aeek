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
if(isset($doc[1]) and !isset($doc[2])) {

    $liste = $events->getEventBySlug($doc[1]);

    if ($eventsData = $liste->fetch()) {
        $eventId =  $eventsData['id_events'];
//        $catData = $categorie->getCategorieById($articleData['categorie_id'])->fetch();
    } else {
        header('location:' . $domaine_admin . '/error');
        exit();
    }

}else{
    $eventId = '';
}
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php';
?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="container mt-5 pt-5">

                <?php
                if(isset($doc[1]) and !isset($doc[2])){
                $listEvts = $events->getEventsBySlug($doc[1])->fetch();
                ?>

                <div class="row mt-5 pt-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row photoContent"></div>
                                <form method="post" enctype="multipart/form-data" id="photoForm">
                                    <input type="file" id="photo" name="photo" style="display: none" accept=".jpeg, .jpg, .png">
                                    <input type="hidden" class="form-control" name="formkey" value="<?=$token?>">
                                    <input type="hidden" class="form-control" name="event_id" value="<?=$listEvts['id_events']?>">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }else{

                ?>
                <div class="row mt-5 pt-5">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header" style="    border-bottom: 0 !important;">
                                <h3 class="card-title">Les evenements</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap border-bottom" id="tableEvents">
                                        <thead>
                                        <tr class="border-bottom">
                                            <th class="wd-15p">Date de création</th>
                                            <th class="wd-15p">Date de l'évènement</th>
                                            <th class="wd-15p">Nom</th>
                                            <th class="wd-15p">Photo</th>
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
                    <div class="col-xl-4">
                        <div class="card p-3">
                            <h2 class="font-20 font-bold" style="font-size: 20px !important; font-weight: bold">Ajouter un évènemente</h2>
                            <form method="post" id="eventForm">
                                <div class="row row-sm">
                                    <div class="form-group text-left pl-2">
                                        <label for="nom">Nom de l'évènemente <i class="required"></i> </label>
                                        <input class="form-control" placeholder="Nom de l'évènemente" type="text" name="nom" id="nom" required>
                                        <input type="hidden" class="form-control" name="formkey" value="<?= $token ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-text btn-transparence-orange">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" name="dateEvent" id="dateEvent" placeholder="Date de l'evènement" type="text">
                                        </div>
                                    </div

                                </div>
                                <div class="text-center" style="border-top: 0 !important;">
                                    <button class="btn btn-green-transparent">Ajouter un évènemente</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>


<?php
require_once 'layout/foot.php';
?>

<script>
    function ajoutPhoto(){
        $('#photo').trigger('click');
    }
    chargePhoto();
    function chargePhoto(){
        $.ajax({
            type: 'post',
            url: '<?=$domaine_admin?>/controller/gallerie.liste.php',
            "data":{
                eventId:"<?=$eventId?>"
            },
            dataType: 'json',
            success: function(data){
                $('.photoContent').html(data.fichierList);
            }
        });
    }

    $('#photo').change(function(e){
        e.preventDefault();
//        $('.loaderPhoto').css('display','block');
        var value = document.getElementById('photoForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/gallerie.save.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            success: function(data){
                if(data == "ok"){
                    chargePhoto();
                }else {
                    swal("Action Impossible !", "Une erreur s\'est produite lors du traitement des données !", "error");
                }
                $('.loaderPhoto').css('display','none');
            }
        });

    });

    // supprimer
    function supPhoto(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer la photo ?",
                    text: "L'action va supprimer la photo sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/gallerie.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                chargePhoto();
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

<script>
    var tableEvents;
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

        $('#dateEvent').datepicker({
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


        tableEvents = $('#tableEvents').DataTable({
            "ajax": {
                "type": "post",
                "url": "<?=$domaine_admin?>/controller/events.liste.php",
                "data": {
                    token: "<?=$token?>"
                }
            },
            "ordering": false,
            "pageLength": 10,
            "language": {
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
                "oPaginate": {
                    "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
                },
                "oAria": {
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
                var valideImage = ["image/jpg", "image/jpeg", "image/png"];

                reader.onload = function (e) {
                    if ($.inArray(fileType, valideImage) < 0) {
                        $('.file-msg').html('<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera mb-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg><br/>Cliquez ou glissez déposez la photo de couverture');
                        inputCouverture.val('');
                        inputCouverture.attr('src', '');
                        swal("Oups format non autorisé !", "Les formats acceptés sont : jpg, jpeg et png !", "error");
                    } else {
                        couverture.css('background-image', 'url(' + e.target.result + ')');
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        inputCouverture.on('dragenter focus click', function () {
            couverture.addClass('is-active');
        });

        inputCouverture.on('dragleave blur drop', function () {
            couverture.removeClass('is-active');
        });

        inputCouverture.on('change', function () {

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

    });





    $('#eventForm').submit(function(e){
        e.preventDefault();
        $('.load').html('<i class="loader-btn"></i>');
        var value = document.getElementById('eventForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/events.save.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            dataType: 'json',
            success: function(data){
//                alert(data.data_info);
                if(data.data_info == "ok"){
                    tableEvents.ajax.reload(null,false);
                    $('.load').html('');
                    $('#cat').val('');
                    swal("Evènement ajouté avec succès!","", "success");
                }else {
                    $('#cat').val('');
                    swal("Impossible d'ajouter l'evènement!", "Une erreur s'est produite lors du traitement des données.", "error");
                }
            },
            error: function (error, ajaxOptions, thrownError) {
                alert(error.responseText);
            }
        });
    });


    function supEvent(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer l'évènemente  ?",
                    text: "L'action va supprimer l'évènemente sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controller/events.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableEvents.ajax.reload(null,false);
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