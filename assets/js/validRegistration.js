/*disabilita submit al controllo ajax*/
var userExist = false;
var mailExist = false;


/*Ajax: controllo del nome unico*/
$('#nome').change(function(){
    var utente = $('#nome').val();
    //console.log(utente);

    var dati = new FormData();
    dati.append('userValidation', utente);

    $.ajax({
        url:'views/modules/ajax.php',
        method: 'POST',
        data: dati,
        contentType: false,
        processData: false,
        cache: false,
        success: function(response){
            console.log('php dice: ' + response);

            if(response == 0){
                $('label[for="nome"] span').html('<p class="alert alert-warning">Nome utente già presente</p>');
                userExist = true;
            }else{
                $('label[for="nome"] span').html('');
                userExist = false;

            }

        }

    });
});


/*Ajax: controllo della mail unica*/

$('#email').change(function(){
    var mail = $('#email').val();
    //console.log(mail);

    var dati = new FormData();
    dati.append('mailValidation', mail);

    $.ajax({
        url:'views/modules/ajax.php',
        method: 'POST',
        data: dati,
        contentType: false,
        processData: false,
        cache: false,
        success: function(response){
            console.log('php dice: ' + response);

            if(response == 0){
                $('label[for="email"] span').html('<p class="alert alert-warning">Mail utente già presente</p>');
                mailExist = true;
            }else{
                $('label[for="email"] span').html('');
                mailExist = false;

            }

        }

    });
});

/*registration page validation*/

function validRegistration(){
var nome = document.querySelector('#nome').value;
//alert(nome);
var mail = document.querySelector('#email').value;
var password = document.querySelector('#password').value;
var policy = document.querySelector('#policy').checked;

    /*Username validation*/
    if(nome != ''){

       var nomeCaratteri = nome.length;
       var regExpr = /^[a-zA-Z0-9]*$/;

       if(nomeCaratteri > 6){
           document.querySelector('label[for="nome"]').innerHTML += '<br><b>Massimo 6 caratteri</b>';
           return false;
       }

       if(!regExpr.test(nome)){
           document.querySelector('label[for="nome"]').innerHTML += '<br><b>Non usare caratteri speciali</b>';
           return false;
       }

       /*controllo dato unico nome utente*/
       if(userExist){
           document.querySelector('label[for="nome"] span').innerHTML = '<p class="alert alert-warning">Nome utente già presente in database</p>';

           return false;
       }
    }

    /*email validation*/

    if(mail != ''){
        var regExpr = /^[^@]+@[^@]+\.[^@]+$/;
        if(!regExpr.test(mail)){
            document.querySelector('label[for="email"]').innerHTML += '<br><b>Attenzione: mail non  corretta</b>';
            return false;
        }

        /*controllo dato unico mail*/
        if(mailExist){
            document.querySelector('label[for="email"] span').innerHTML = '<p class="alert alert-warning">Mail utente già presente in database</p>';
            return false;
        }
    }

    /*password validation*/

    if(password != ''){
        var regExpr = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$/!%*?&])[A-Za-z0-9@/$!%*?&]{8,}$/;
        if(!regExpr.test(password)){
            document.querySelector('label[for="password"]').innerHTML += '<br><b>Serve almeno: 1 numero,1 maiuscola,1 carattere speciale </b>';
            return false;
        }
    }

    /*policy validation*/
    if(!policy){
        document.querySelector('form').innerHTML += '<br><b>Non hai accettato i termini e le condizioni</b>';

        document.querySelector('#nome').value = nome;
        document.querySelector('#email').value = mail;
        document.querySelector('#password').value = password;

        return false;

    }

    return true;
}
