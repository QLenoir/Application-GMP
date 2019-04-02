<?php
if (isset($_SESSION['eleve'])){
    header('Location: index.php?page=10');
} elseif (isset($_SESSION['enseignant'])) {
    header('Location: index.php?page=1');
}

if(empty($_POST['mdp'])) { ?>
    <div class="row justify-content-center contenuConnexion">
        <div class="col-9 col-md-6">
            <div class="row justify-content-center">
                <div class="col-sm-5 logoConnexion">
                    <img class="logoConnexion" src="image/board.png" alt="logo" title="Intera Notes">
                </div>
                <div class="col-sm-7 text-center interaNoteConnexion">
                    <h2>Intera Note</h2>
                </div>
            </div>

            <form action="index.php?page=0" method="post">
                <div class="row">
                    <div class="col-12">
                        <input class="inputConnexion" type="text" name="login" placeholder="Identifiant" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input class="inputConnexion" type="password" name="mdp" placeholder="Mot de passe" required>
                    </div>
                </div>

                <div class="linkMdpOoublie">
                    <a href="index.php?page=43">Mot de passe oublié ?</a>
                </div>

                <div class="row buttonConnexion">
                    <div class="col-7">
                        <input type="submit" name="submit" value="Connexion">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } else {

    $db = new Mypdo();
    $personneManager = new PersonneManager($db);

    $log = $personneManager->verifierInfosConnexion($_POST['login'],createProtectedPassword($_POST['mdp']));

    switch ($log) {
        case "erreurConnexion":
        ?>
        <div class="row justify-content-center contenuConnexion">
            <div class="col-9 col-md-6">
                <div class="row justify-content-center">
                    <div class="col-sm-5 logoConnexion">
                        <img class="logoConnexion" src="image/board.png" alt="logo" title="Intera Notes">
                    </div>
                    <div class="col-sm-7 text-center interaNoteConnexion">
                        <h2>Intera Note</h2>
                    </div>
                </div>

                <form action="index.php?page=0" method="post">
                    <div class="messageErreurConnexion">
                        <img src="image/erreur.png" alt="Erreur" title="Erreur connexion" />
                        <span style="font-weight:bold">Login / Mot de passe incorrect</span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input class="inputConnexion" type="text" name="login" placeholder="Identifiant" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input class="inputConnexion" type="password" name="mdp" placeholder="Mot de passe" required>
                        </div>
                    </div>

                    <div class="linkMdpOoublie">
                        <a href="index.php?page=43">Mot de passe oublié ?</a>
                    </div>

                    <div class="row buttonConnexion">
                        <div class="col-7">
                            <input type="submit" name="submit" value="Connexion">
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <?php
        break;

        case "eleve":
          $_SESSION['eleve']=$_POST['login'];
          header('Location: index.php?page=10');
          break;

        case "enseignant":
          $_SESSION['enseignant']=$_POST['login'];
          header('Location: index.php?page=1');
          break;

        default:
          header('Location: index.php?page=0');
          break;
    }
} ?>
