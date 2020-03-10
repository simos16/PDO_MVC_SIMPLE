<?php
session_start();

if(!$_SESSION['validation']){

    header('location:index.php?action=login');

    exit();
}
?>



<h2>UTENTI</h2>
<?php

if(isset($_GET['action'])){

    if($_GET['action'] == 'edit'){

        echo 'hai aggiornati i dati';
    }
}

?>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Gestisci</th>
        <th></th>

    </tr>
    </thead>

    <tbody>

    <?php
    $mostraUtenti = new MvcController();
    $mostraUtenti->mostraUtentiController();
    $mostraUtenti->cancellaUtenteController();


    ?>

    </tbody>
</table>

