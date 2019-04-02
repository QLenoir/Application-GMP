<?php
if (isset($_SESSION['eleve']) || isset($_SESSION['enseignant'])){

    if(empty($_POST['new_password'])){

        ?>
        <div class="afficherMsgErreur">
            <?php
            if(!empty($_SESSION['errMsg'])) {
                echo "<p><b><img class='icone' src='image/erreur.png'>".$_SESSION['errMsg']."</b></p>";
                unset($_SESSION['errMsg']);
            }
            ?>
        </div>

        <div class="form-wrapper">
            <form method="post" action="#">

                <div class="form-group">
                    <label for="old_password" class="form-label">Ancien mot de passe</label>
                    <input class="form-input" type="password" id="old_password" name="old_password"  required/>
                </div>

                <div class="form-group">
                    <label for="new_password" class="form-label">Nouveau mot de passe</label>
                    <input class="form-input" type="password" id="new_password" name="new_password" required/>
                </div>

                <div class="form-group">
                    <label for="conf_password" class="form-label">Retapez mot de passe</label>
                    <input class="form-input" type="password" id="conf_password" name="conf_password" required/>
                </div>

                <div class="form-group divMdpButton">
                    <input class="detailMdpButton" type="submit" value="Valider" class="btn"/>
                </div>

            </form>
        </div>

        <?php
    }else{

        if (isset($_SESSION['eleve'])){
            $login = $_SESSION['eleve'];
        }else{
            $login = $_SESSION['enseignant'];
        }

        if($_POST['new_password'] === $_POST['conf_password']){

            $pdo = new Mypdo();
            $personneManager = new PersonneManager($pdo);
            $infosConnexion = $personneManager->verifierInfosConnexion($login, createProtectedPassword($_POST['old_password']));

            if($infosConnexion === "enseignant" || $infosConnexion === "eleve"){
                $personne = $personneManager->getPersonneByLogin($login);

                $retour = $personneManager->updatePasswordOfPersonne($personne->getIdPersonne(), createProtectedPassword($_POST['new_password']));

                if($retour){?>

                    <div class="msgConfirmTitre">
                        <h3>Message de confirmation</h3>
                        <p>Votre mot de passe a bien été modifié !</p>
                    </div>

                    <?php
                }else{
                    $_SESSION['errMsg'] = "Erreur interne : votre mot de passe n'a pu être modifié";
                    header('Location: index.php?page=42');
                }

            }else{
                $_SESSION['errMsg'] = "L'ancien mot de passe renseigné est incorrect";
                header('Location: index.php?page=42');
            }

        }else{
            $_SESSION['errMsg'] = "La confirmation du mot de passe est invalide, les 2 mots de passe doivent être identiques";
            header('Location: index.php?page=42');
        }
    }
}else{
    header('Location: index.php?page=0');
}
