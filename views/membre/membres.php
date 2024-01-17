<?php
$myIp =  Detect::ip();
//echo $myIp;
//exit;
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeek'])){
    header('location:'.$domaine_admin.'/login');
    exit();
}
$result = json_decode(getDataByUrl('http://ip-api.com/json/'.$myIp),true);
if($result['status'] == 'success'){
    $countryCode = $result['countryCode'];
}else{
    $countryCode = 'CI';
}

$rs = $admin->getAllAdmin();

if($adList = $rs->fetch()){
    $totalAd = $admin->nbAdmin()->fetch();
    $totalAdEnAtt = $admin->nbAdminEnAttent()->fetch();
    $totalABlq = $admin->nbAdminBloquer()->fetch();
    $totalAVal = $admin->nbAdminValider()->fetch();
    $nbAd = $totalAd['nb'];
    $nbAdEnAttent = $totalAdEnAtt['nb'];
    $nbAdBloquer = $totalABlq['nb'];
    $totalAValider = $totalAVal['nb'];
}else{
    $nbAd = 0;
    $nbAdEnAttent = 0;
    $nbAdBloquer = 0;
    $totalAValider = 0;
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
                <div class="row reloaded">
                    <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                        <div class="card">
                            <div class="row">
                                <div class="col-4">
                                    <div class="circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                                        <img src="<?=$asset?>/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                        <i class="fa fa-user-o text-success fa-3x fs-30  text-white mt-4"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body p-4">
                                        <h2 class="mb-2 fw-normal mt-2"><?=$nbAd?></h2>
                                        <h5 class="fw-normal mb-0">Membres</h5>
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
                                        <i class="fa fa-user-o text-success fa-3x  text-white mt-4"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body p-4">
                                        <h2 class="mb-2 fw-normal mt-2"><?=$nbAdEnAttent?></h2>
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
                                        <i class="fa fa-user-o text-success fa-3x text-white mt-4"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body p-4">
                                        <h2 class="mb-2 fw-normal mt-2"><?=$totalAValider?></h2>
                                        <h5 class="fw-normal mb-0">Valider</h5>
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
                                        <i class=" fa fa-user-o text-success fa-3x text-white mt-4"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body p-4">
                                        <h2 class="mb-2 fw-normal mt-2"><?=$nbAdBloquer?></h2>
                                        <h5 class="fw-normal mb-0">Bloquer</h5>
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
                                <h3 class="card-title">Les membres</h3>
                            </div>
                            <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                                <a href="#modalAddMembre" class="btn-transparence-orange"  data-bs-effect="effect-sign" data-bs-toggle="modal"  style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter un membre</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap border-bottom" id="tableMmbres">
                                        <thead>
                                        <tr class="border-bottom">
                                            <th class="wd-15p">Date de création</th>
                                            <th class="wd-15p">Nom & prénom</th>
                                            <th class="wd-15p">Téléphone</th>
                                            <th class="wd-15p">Email</th>
                                            <th class="wd-15p">Rôle</th>
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

        <div class="modal fade" id="modalAddMembre">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo p-5">
                    <div class="modal-header" style="border-bottom: 0 !important;">
                     <h2>Ajouter un membre</h2>
                    </div>
                    <form method="post" id="addMembreForm">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="nom">Nom  <i class="required"></i></label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" required>
                                <input type="hidden" class="form-control" name="formkey" value="<?=$token?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="prenom">Prénom <i class="required"></i></label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" required>
                            </div>
                        </div>
                        <label for="role" class="col-md-3 form-label m-0 p-0 pb-2">Rôle</label>
                        <div class="">
                            <select name="role" id="role" class="form-control form-select select2 input-style" data-bs-placeholder="Select Country">
                                <option value="1">Admin</option>
                                <option value="2">Editeur</option>
                                <option value="3">Membre</option>
                                <option value="4">Candidat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="phone">Téléphone <i class="required"></i></label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="tel" class="form-control" name="phone" id="phone" value="" required>
                                <input type="hidden"  name="isoPhone" id="isoPhone" value="value="">
                                <input type="hidden"  name="dialPhone" id="dialPhone" value="">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-green-transparent"> <i class="load"></i> Ajouter un membre</button>
                            <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
<!--        <div class="modal fade" id="modalAddMembre">-->
<!--            <div class="modal-dialog modal-dialog-centered" role="document">-->
<!--                <div class="modal-content modal-content-demo p-5">-->
<!--                    <div class="modal-header" style="border-bottom: 0 !important;">-->
<!--                     <h2>Ajouter un membre</h2>-->
<!--                    </div>-->
<!--                    <form method="post" id="addMembreForm">-->
<!--                        <div class="form-group">-->
<!--                            <div class="form-label-group">-->
<!--                                <label class="form-label" for="nom">Nom  <i class="required"></i></label>-->
<!--                            </div>-->
<!--                            <div class="form-control-wrap">-->
<!--                                <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" required>-->
<!--                                <input type="hidden" class="form-control" name="formkey" value="--><?//=$token?><!--">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <div class="form-label-group">-->
<!--                                <label class="form-label" for="prenom">Prénom <i class="required"></i></label>-->
<!--                            </div>-->
<!--                            <div class="form-control-wrap">-->
<!--                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" required>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <div class="form-label-group">-->
<!--                                <label class="form-label" for="email">Email <i class="required"></i></label>-->
<!--                            </div>-->
<!--                            <div class="form-control-wrap">-->
<!--                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <label for="role" class="col-md-3 form-label m-0 p-0 pb-2">Rôle</label>-->
<!--                        <div class="">-->
<!--                            <select name="role" id="role" class="form-control form-select select2 input-style" data-bs-placeholder="Select Country">-->
<!--                                <option value="1">Admin</option>-->
<!--                                <option value="2">Editeur</option>-->
<!--                                <option value="3">Membre</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <div class="form-label-group">-->
<!--                                <label class="form-label" for="phone">Téléphone <i class="required"></i></label>-->
<!--                            </div>-->
<!--                            <div class="form-control-wrap">-->
<!--                                <input type="tel" class="form-control" name="phone" id="phone" value="" required>-->
<!--                                <input type="hidden"  name="isoPhone" id="isoPhone" value="value="">-->
<!--                                <input type="hidden"  name="dialPhone" id="dialPhone" value="">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group text-center">-->
<!--                            <button class="btn btn-green-transparent"> <i class="load"></i> Ajouter un membre</button>-->
<!--                            <a href="javascript:void(0);" class="btn btn-red-transparent" data-bs-dismiss="modal">Annuler</a>-->
<!--                        </div>-->
<!--                    </form>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="modal fade" id="modalUpdComment">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo p-5">
                    <div class="modal-header" style="border-bottom: 0 !important;">
                        <h3 class="modal-title">Commentaire de : <span id="nom"></span> </h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" id="comentUpdForm">
                        <div class="modal-body">
                            <div class="updSucces"></div>
                            <div class="updError"></div>
                        </div>
                        <div class="row row-sm">
                            <div class="form-group text-left pl-2">
                                <label for="cat">Vous pouvez modifier le commentaire <i class="required"></i> </label>
                                <textarea class="form-control" placeholder="Nom de la catégorie" rows="10" name="message" id="message" required></textarea>
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
    var tableMmbres;

    $(document).ready(function() {

        $('#addMembreForm').submit(function(e){
            e.preventDefault();
            $('.load').html('<i class="loader-btn"></i>');
            var value = document.getElementById('addMembreForm');
            var form = new FormData(value);

            $.ajax({
                method: 'post',
                url: '<?=$domaine_admin?>/controller/can.inscription.php',
                data: form,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'json',
                success: function(data){
//                alert(data.data_info);
                    if(data.data_info == "ok"){
                        tableMmbres.ajax.reload(null,false);
                        $('.load').html('');
                        $(".reloaded").load(location.href + " .reloaded");
                        swal("Succès !","Le membre a été ajouté avec succès","success");
                        $('#nom').val('');
                        $('#prenom').val('');
                        $('#isoPhone').val('');
                        $('#dialPhone').val('');
                    }else if(data.data_info == 1){
                        swal("Oups !","Ce numéro de téléphone existe déjà !","error");
                        $('.load').html('');

                    }else {
                        swal("Oups !","Une erreur s\'est produite, veuillez réessayer !","error");
                        $('.load').html('');
                    }
                },
                error: function (error, ajaxOptions, thrownError) {
                    alert(error.responseText);
                }
            });
        });





        $("#phone").keyup(function (event) {
            if (/\D/g.test(this.value)) {
                //Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });

        var inputPhone = document.querySelector("#phone");
        window.intlTelInput(inputPhone, {
            initialCountry: '<?=$countryCode?>',
            utilsScript: "<?=$asset?>/plugins/intltelinput/js/utils.js"
        });
        var iti = window.intlTelInputGlobals.getInstance(inputPhone);
        var countryData = iti.getSelectedCountryData();
        $('#isoPhone').val(countryData["iso2"]);
        $('#dialPhone').val(countryData["dialCode"]);
        inputPhone.addEventListener("countrychange", function() {
            var iti = window.intlTelInputGlobals.getInstance(inputPhone);
            var countryData = iti.getSelectedCountryData();
            $('#isoPhone').val(countryData["iso2"]);
            $('#dialPhone').val(countryData["dialCode"]);
        });



        tableMmbres = $('#tableMmbres').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/admin.liste.php",
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
                        $.post('<?=$domaine_admin?>/controller/admin.bloquer.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableMmbres.ajax.reload(null,false);
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
                        $.post('<?=$domaine_admin?>/controller/admin.debloquer.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableMmbres.ajax.reload(null,false);
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
                        $.post('<?=$domaine_admin?>/controller/admin.delete.php', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableMmbres.ajax.reload(null,false);
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