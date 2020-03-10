<?php 

if(isset($_POST['submit'])){
    
    $secret = '6Lejt7sUAAAAAHPaWMWZ5RrJ88VC2hbDFe_a1O6x';
    $response = $_POST['g-recaptcha-response'];
    var_dump($response);
    $remoteip = $_SERVER['REMOTE_ADDR'];
    
    $verifica = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    
    $risposta = file_get_contents($verifica);
    var_dump($risposta);
    
    $risposta = json_decode($risposta);
    
    if($risposta->success){
        echo 'verifica positiva';
    }else{
        echo 'verifica fallita';
    }
}

?>




<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<html>
<head>
    <title>Esempio di recaptcha</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<form action="recaptcha.php" method="post">
    <input type="text" name="username" placeholder="tuo nome"><br>
   
   <div class="g-recaptcha" data-sitekey="6Lejt7sUAAAAAPnrkDY63yNYfEgiEu9_bpK1Yf4p"></div>
    <input type="submit" name="submit" value="Invia">
</form>
</body>
</html>
