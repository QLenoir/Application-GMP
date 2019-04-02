<?php
require_once("include/autoLoad.inc.php");
require_once("include/functions.inc.php");
require_once("include/config.inc.php");

session_start();
date_default_timezone_set('Europe/Paris');
?>

<?php
require_once("include/titre.inc.php");
require_once("include/header.inc.php");
?>
<div class="container-fluid">
    <?php
    require_once("include/texte.inc.php");
    ?>
</div>

<div id="spacer"></div>

<?php
require_once("include/footer.inc.php");
?>
