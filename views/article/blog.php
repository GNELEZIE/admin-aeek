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

$listeCat = $categorie->getAllCategorie();
require_once 'controller/article.save.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/header.php';
if(isset($doc[1]) and !isset($doc[2])){
    $liste = $article->getArticleBySlug($doc[1]);

    if($articleData = $liste->fetch()) {

        $catData = $categorie->getCategorieBySlug($articleData['categorie'])->fetch();
    }else{
        header('location:'.$domaine_admin.'/error');
        exit();
    }
    ?>

    <!--Article editor-->
    <div class="row mt-5 pt-5">
        <div class="col-xl-8">
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
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-md-3 form-label">Categories :</label>
                            <div class="">
                                <select name="categorie" id="categorie" class="form-control form-select select2 input-style" data-bs-placeholder="Select Country">
                                    <option value="<?=$catData['slug']?>"><?=html_entity_decode(stripslashes($catData['nom']))?></option>
                                    <?php
                                    while($cat = $listeCat->fetch()) {

                                        ?>
                                        <option value="<?=$cat['slug']?>"><?=$cat['nom']?></option>
                                    <?php
                                    }
                                    ?>
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
                        <button  class="btn btn-transparence-orange"> <i class="loader"></i> Modifier l'article maintenant</button>
                    </div>
                </form>


            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Article recents</div>
                </div>
                <div class="card-body">
                    <div class="couv mb-5">
                        <img src="<?=$domaine_admin?>/uploads/<?=$articleData['couverture']?>" width="250px" alt=""/>
                    </div>
                    <div class="card-btn pl-3" style="border-bottom: 0 !important; padding-left: 20px;">
                        <a href="<?=$domaine_admin?>/add-article" class="btn-transparence-orange" style="padding: 7px 15px; border-radius: 3px;"> <i class="fa fa-plus"></i> Modifier la couverture</a>
                    </div>
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
                                    <th class="wd-15p">Description</th>
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





</script>