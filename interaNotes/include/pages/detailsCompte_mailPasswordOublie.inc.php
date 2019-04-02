<?php
if(isset($_SESSION['mail'])){

$mail = $_SESSION['mail']; // Déclaration de l'adresse de destination.
$passwd = $_SESSION['passwd']; //Récupération du mot de passe à insérer dans le mail

unset($_SESSION['mail']);
unset($_SESSION['passwd']);

$passage_ligne = "\n";

//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Intera Notes\n
Des problèmes de connexion ?\n
Vous avez récemment demander un nouveau mot de passe pour votre compte Intera Notes.\n
Votre mot de passe : ".$passwd."\n\n
Veuillez le modifier le plus rapidement possible. Pour cela, rendez vous sur votre 'Profil' puis sur 'Modifier mon mot de passe'.\n
Merci et à bientôt sur Intera Notes !\n
L'équipe Intera Notes.";

$message_html ="
<html>
  <head>
  </head>
  <body style='width:75%; margin-left:8%; float:left;'>
      <h1 align='center' style='color:white; background-color:#333333; border-radius:25px 25px 0 0; margin-bottom:0;'>Intera Notes</h1>
    <div style='border:solid black 1px; padding:0 10px;'>
      <h2 style='margin-left:5%;'>Des problèmes de connexion ? </h2>
      <p>Vous avez récemment demander un nouveau mot de passe pour votre compte Intera Notes.</p>
      <p>Votre nouveau mot de passe : <b>".$passwd."</b></p>
      </br>
      <p>Veuillez le modifier le plus rapidement possible. Pour cela, rendez vous sur votre 'Profil' puis sur 'Modifier mon mot de passe'.
     </p>
      <p>Merci et à bientôt sur Intera Notes !</p>
      <p align='right'>L'équipe Intera Notes</p>
    </div>
  </body>
</html>";
//==========

//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========

//=====Définition du sujet.
$sujet = "Mot de passe oublié";
//=========

//=====Création du header de l'e-mail.
$header = "From: \"Intera Notes\"<developpement_web@laposte.net>".$passage_ligne;
$header.= "Reply-to: \"Intera Notes\"<developpement_web@laposte.net>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
$retour = mail($mail,$sujet,$message,$header);
//==========

//======Vérification de l'envoi
if($retour){?>
  <div class="msgErrorTitre">
    <h3>Mot de passe oublié ?</h3>
    <p>Un nouveau mot de passe vous a été attribué, vous le trouverez dans le mail envoyé !</p>
  </div>

<?php
}else{ ?>

  <div class="msgErrorTitre">
    <h3>Echec de l'envoi</h3>
    <p>Un problème est survenu lors de l'envoi du mail, veuillez réessayer dans quelques minutes !</p>
  </div>

<?php
}
//=========

}else{
  header('Location: index.php?page=0');
}

?>
