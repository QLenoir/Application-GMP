<?php if(isset($_SESSION['eleve'])) {
    header('Location: index.php?page=10');
} if(!isset($_SESSION['enseignant'])){
    header('Location: index.php?page=0');
}?>
