<?php
session_start();

if(!$_SESSION['validation']){

    header('location:index.php?action=login');

    exit();
}
?>



<h2 class="my-5">Aggiorna le informazioni</h2>

<form method="post">
    <?php
 $modifica = new MvcController();
 $modifica ->modificaUtenteController();
 $modifica->aggiornaUtenteController();
  ?>
</form>
