<?php
if(isset($_SESSION['objet'])){
  //WARNING:mettre l'email du prof concerné
$mail = "charlie.leger@etu.unilim.fr"; // Déclaration de l'adresse de destination.
$mailEtudiant = $_SESSION['mail'];
$sujet = "Vous avez recu une nouvelle question !"; // Déclaration du sujet du mail.
$contenu= $_SESSION['contenu']; // Déclaration de l'objet du mail.
$objet= $_SESSION['objet']; // Déclaration de l'objet du mail.
$nom= $_SESSION['nom']; // Déclaration du nom de l'élève
$prenom= $_SESSION['prenom']; // Déclaration du prenom de l'élève.

unset($_SESSION['mail']);
unset($_SESSION['objet']);
unset($_SESSION['contenu']);
unset($_SESSION['nom']);
unset($_SESSION['prenom']);

$passage_ligne = "\n";

//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Intera Notes\n
Vous avez recu une nouvelle question\n
Vous avez recu une nouvelle question de ".$prenom." ".$nom."\n
  ".$objet."\n
  ".$contenu."\n
  \n

  Répondez à l'étudiant en utilisant cette adresse mail : ".$mailEtudiant."\n
";

$message_html ="
<html>
  <head>
  </head>
  <body style='width:75%; margin-left:8%; float:left;'>
      <h1 align='center' style='color:white; background-color:#333333; border-radius:25px 25px 0 0; margin-bottom:0;'>Intera Notes</h1>
    <div style='border:solid black 1px; padding:0 10px 3%;'>
      <h2 align='center' >Vous avez recu une nouvelle question de <b>".$prenom." ".$nom."</b></h2>
      <h2 align='center' style='font-weight: normal; '>Adresse email : <i>".$mailEtudiant."</i></h2>
      <h3>".$objet."</h3>
      <p style='padding: 0 5% 0 5%; text-align:justify;'>".$contenu."</b></p>
      </br>
      <a align='center' style='border: 0;
    border-radius: 50px;
    background-color: #333;
    color: #ededed;
    padding : 5px 10px;
    width: 200px;
    cursor: pointer;
    margin-left: 40%;
    ' href='mailto:".$mailEtudiant."'> Répondre </a>
    </div>
  </body>
</html>";
//==========

//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========

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
  <div class="msgConfirmTitre">
    <h3>Message de confirmation</h3>
    <p>Votre question a bien été envoyée à votre professeur !</p>
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
