<?php if(!isset($_POST["chemin"]) && !isset($_POST["supprimer"])) {
    $db = new Mypdo();
    $imageManager = new ImageManager($db);
    ?>

    <div class="row headGestionImage">
        <div class="col">
            <h4>Gestion des images</h4>
            <hr>
        </div>
    </div>

    <form method="post" action="index.php?page=8">
        <div class="row justify-content-center bodyGestionImage">
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <h6>Ajouter une photo :</h6>
                    </div>
                    <div class="col-12">
                        <input type="file" name="chemin" id="chemin" class="inputfile inputfile-3"  onchange="desactiverFormulaire()" required/>
                        <label for="chemin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                            </svg>
                            <span>Choisissez une image&hellip;</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <h6>Supprimer une photo :</h6>
                    </div>
                    <div class="col-12">
                        <select class="form-control" name="supprimer" id="supprimer" onchange="desactiverFormulaire()" required>
                            <option hidden selected></option>
                            <?php $listeImages = $imageManager->getAllImages();
                            foreach ($listeImages as $key => $value) { ?>
                                <option value="<?php echo $value->getIdImage();?>" > <?php echo $value->getCheminImage(); ?> </option>
                            <?php  } ?>
                        </select>
                        <p> <sup> Attention : irréversible ! </sup> </p>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center">
                <input type="submit" value="Valider">
            </div>
        </div>
    </form>

<?php } else {
    $db = new Mypdo();
    $imageManager = new ImageManager($db);

    if(isset($_POST["chemin"])) {
        $imageManager->ajouterImage($_POST["chemin"]); ?>
        <p> Votre photo a été ajoutée sur Intera Notes ! </p>
    <?php  } else {
        $imageManager->supprimerImage($_POST["supprimer"]); ?>
        <p> Votre photo a été supprimée de Intera Notes ! </p>
    <?php  }
} ?>
