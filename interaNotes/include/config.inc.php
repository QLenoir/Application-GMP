<?php
// Paramètres de l'application Covoiturage
// A modifier en fonction de la configuration

// WARNING: A MODIFIER

define('DBHOST', "localhost");
define('DBNAME', "intera_notes");
define('DBUSER', "bd");
define('DBPASSWD', "bede");
define('ENV','dev');
define('DBPORT',3306);

define('SALT','27#!@mgfe');
define('PASSWORD_LENGTH', 10);
// pour un environememnt de production remplacer 'dev' (développement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>
