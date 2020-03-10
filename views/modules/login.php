<h2>LOGIN</h2>

<form method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="la tua mail" name="mail">

    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="password" name="password">
    </div>
    
    <?php 
    $login = new MvcController();
    $login->loginUtenteController();
    ?>
    <div class="g-recaptcha" data-sitekey="6Lejt7sUAAAAAPnrkDY63yNYfEgiEu9_bpK1Yf4p"></div>
    <button type="submit" class="btn btn-block btn-primary mt-3" name="login">Invia</button>
</form>

<?php

//$login = new MvcController();
//$login->loginUtenteController();

if(isset($_GET['action'])){
    if($_GET['action'] == 'errore'){
        echo 'login fallito';
    }
    
     //if($_GET['action'] == 'captchafail'){
       // echo 'fai attenzione al captcha';
    //}
}

?>