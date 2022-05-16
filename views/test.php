<div class="card">
    <div class="card-header">
        <div class="card-title">Ajouter une bannière</div>
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
            <?php } ?>
            <div class="row mb-4">

                <div class="form-group">
                    <label for="titre" class="col-md-3 form-label">Titre de la bannière</label>
                    <input type="text" class="form-control input-style" name="titre" id="titre" placeholder="Titre de la bannière" required>
                    <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                </div>
                <div class="form-group">
                    <label for="sous_titre" class="col-md-3 form-label">Sous Titre </label>
                    <input type="text" class="form-control input-style" name="sous_titre" id="sous_titre" placeholder="Sous titre" required>
                </div>
            </div>

            <div class="form-group">
                <div class="py-3">
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
            <button  class="btn btn-transparence-orange"> <i class="loader"></i> Publier l'article maintenant</button>
        </div>
    </form>


</div>