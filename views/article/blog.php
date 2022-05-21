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






//require_once 'controller/article.save.php';

require_once 'controller/article.update.php';

if(isset($doc[1]) and !isset($doc[2])) {

    $liste = $article->getArticleBySlug($doc[1]);

    if ($articleData = $liste->fetch()) {

        $catData = $categorie->getCategorieById($articleData['categorie_id'])->fetch();
    } else {
        header('location:' . $domaine_admin . '/error');
        exit();
    }
}

//$listeCat = $categorie->getAllCategorie();
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/header.php';
    ?>

    <?php
    if(isset($doc[1]) and !isset($doc[2])){
    ?>
    <!--Article editor-->
    <div class="row mt-5 pt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Modifier l'article</div>
                </div>
                <form method="post" id="addArticleForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php if (!empty($success)) { ?>
                            <div class="alert alert-success" style="font-size: 14px" role="alert">
                                <?php foreach ($success as $succ) { ?>
                                    <?php echo $succ ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($errors)) { ?>
                            <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                <?php foreach ($errors as $error) { ?>
                                    <?php echo $error ?>
                                <?php } ?>
                            </div>
                        <?php }


                        ?>
                        <div class="row mb-4">
                            <label class="col-md-3 form-label">Titre de l'article :</label>
                            <div class="">
                                <input type="text" class="form-control input-style" name="titre" id="titre" placeholder="Titre de l'article" value="<?= html_entity_decode(stripslashes($articleData['titre']))?>" required>
                                <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                                <input type="hidden" class="form-control " name="artIds" value="<?= $articleData['id_article'] ?>">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-md-3 form-label">Categories :</label>
                            <div class="">
                                <select name="categorie" id="categorie" class="form-control form-select select2 input-style" data-bs-placeholder="Select Country">
                                    <option value="<?=$catData['id_categorie']?>"><?=html_entity_decode(stripslashes($catData['nom']))?></option>
                                    <?php
//
//                                    while($cat = $listeCat->fetch()) {
//
//                                        ?>
<!--                                        <option value="--><?//=$cat['id_categorie']?><!--">--><?//=$cat['nom']?><!--</option>-->
<!--                                    --><?php
//                                    }
//                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row">
                            <label class="col-md-3 form-label mb-4">Description :</label>
                            <div class="mb-4">
                                <textarea class="content input-style" name="summernote" id="summernote" placeholder="Description"><?= html_entity_decode(stripslashes($articleData['description']))?></textarea>
                            </div>
                        </div>
                        <!--End Row-->
                    </div>
                    <div class="card-footer text-center">
                        <button  class="btn btn-green-transparent"> <i class="loader"></i> <span class="fe fe-edit"> </span> Modifier l'article maintenant</button>
                    </div>
                </form>


            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="height: 368px;">
                <div class="card-body m-0 p-0">
                    <form method="post" id="userImgForm" enctype="multipart/form-data">
                        <div class="couv mb-5">
                            <img src="<?=$domaine_admin?>/uploads/<?php if($articleData['couverture'] != ''){echo $articleData['couverture'];}else{echo 'user.png';}?>" class="img-couv" id="imguser" alt="" style="border-radius: 7px 7px 0 0;"/>
                            <input type="file" name="userImg" id="userImg" style="display: none"/>
                            <input type="hidden" class="form-control " name="artId" value="<?= $articleData['id_article'] ?>">
                        </div>
                        <div class="card-btn pl-3 text-center" style="border-bottom: 0 !important;">
                            <a href="javascript:void(0);" class="btn-transparence-orange" id="btn-img" style="padding: 7px 15px; border-radius: 3px;"> <span class="fe fe-edit"> </span> Modifier la photo couverture</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Article editor-->
<?php
}else{
    ?>

    <div class="container pt-5 mt-5">
        <div class="row pt-5 mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="    border-bottom: 0 !important;">
                        <h3 class="card-title">Les articles</h3>
                    </div>
                    <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                        <a href="<?=$domaine_admin?>/add-article" class="btn-transparence-orange" style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Ajouter un article</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap border-bottom" id="tableArticle">
                                <thead>
                                <tr class="border-bottom">
                                    <th class="wd-15p">Date</th>
                                    <th class="wd-15p">Titre</th>
                                    <th class="wd-15p">Catégorie</th>
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
<?php
}

?>




<?php
require_once 'layout/footer.php';
?>

<script>
    var tableArticle;
    $(document).ready(function() {
        tableArticle = $('#tableArticle').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controller/article.liste.php",
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

    // bloquer
    function bloquer(id = null){
        if(id){
            swal({
                    title: "Voulez vous mettre hors ligne cet article ?",
                    text: "L'action va mettre hors l'article",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0acf97",
                    confirmButtonText: "Oui, Bloquer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $('.confirm').html('<i class="loader-btn"></i> Oui, Valider');
                        $.post('<?=$domaine_admin?>/controller/bloquer.article.php', {token : '<?=$token?>',id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableArticle.ajax.reload(null,false);
                            }else{
                                swal("Impossible de mettre hors ligne l'article!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }
    function valider(id = null){
        if(id){
            swal({
                    title: "Voulez vous mettre en ligne cet article ?",
                    text: "L'action va mettre en ligne l'article",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0acf97",
                    confirmButtonText: "Oui, Valider",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $('.confirm').html('<i class="loader-btn"></i> Oui, Valider');
                        $.post('<?=$domaine_admin?>/controller/valider.article.php', {token : '<?=$token?>',id : id}, function (data) {
                            if(data == "ok"){
                                swal("Opération effectuée avec succès!","", "success");
                                tableArticle.ajax.reload(null,false);
                            }else{
                                swal("Impossible de mettre en ligne l'article!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

    $('#btn-img').click(function(e){
        e.preventDefault();
        $('#userImg').trigger('click');
    });

    //fonction vue image télécharger
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imguser').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#userImg').change(function(e){
        e.preventDefault();
        readURL(this);
        var value = document.getElementById('userImgForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/photo.save.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            dataType: 'json',
            success: function(data){
                if(data.data_info == "ok"){
                    $('#imguser').attr('src', data.data_photo);
                }else {
                    swal("Action Impossible !", "Une erreur s\'est produite lors du traitement des données !", "error");
                }
            }
        });

    });


</script>