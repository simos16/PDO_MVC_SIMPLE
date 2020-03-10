<?php

ob_start();
class MvcController{

	public function pagina(){	
		
		include "views/template.php";
	
	}

	public function linkPagineController(){

		if(isset( $_GET['action'])){
			
			$links = $_GET['action'];
		
		}

		else{

			$links = "index";
		}

		$response = Pagine::linkPagineModel($links);

		include $response;

	}

	//CREATE = inserimento nuovi dati

    public function registraUtenteController()
    {

        if(isset($_POST['submit'])) {
$securePassword = crypt($_POST['password'], '$5$q0BOeNCdrtpYeChR7ROQ3dvUTNPiWbhG8x7HSydU$');
            $datiController = array(
                "nome" => $_POST["nome"],
                "email" => $_POST["email"],
                "password" => $securePassword
            );

            $responseDb = Dati::registraUtenteModel($datiController, "utenti");
            //echo $responseDb;

            if($responseDb == 'successo'){

                header('location:ok');

            }else{
                header('location: index.php');
            }
        }
    }

    //GESTIONE LOGIN

    public function loginUtenteController()
    {

        if (isset($_POST['login'])) {
            $securePassword = crypt($_POST['password'], '$5$q0BOeNCdrtpYeChR7ROQ3dvUTNPiWbhG8x7HSydU$');

            $datiController = array(
                "email" => $_POST["mail"],
                "password" => $securePassword
            );

            $responseDb = Dati::loginUtenteModel($datiController, "utenti");
//CAPTCHA
$secret = '6Lejt7sUAAAAAHPaWMWZ5RrJ88VC2hbDFe_a1O6x';
$response = $_POST['g-recaptcha-response'];
$remoteip = $_SERVER['REMOTE_ADDR'];

$captchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
$captcha = json_decode($captchaVerify);

if($captcha->success){
         
            if ($responseDb["email"] == $_POST['mail'] && $responseDb["password"] == $securePassword) {

                //inizio una sessione
                session_start();

                //creo una variabile di sessione
                $_SESSION['validation'] = true;

                header('location:utenti');
            }
}else if(empty($_POST['g-recaptcha-response'])){
    //header('location:index.php?action=captchafail');
    echo '<div class="alert alert-warning my-3">Non hai flaggato il captcha</div>';
    
}
       
                else {

                    header('location:errore');
                }
        }
    }
// MOSTRA UTENTI
    public function mostraUtentiController(){

        $responseDb = Dati::mostraUtentiModel("utenti");

     foreach($responseDb as $row=>$data){
         echo '<tr>
        <td>' . $data["nome"]     . '</td>
        <td>' . $data["email"]    . '</td>
        <td>' . $data["password"] . '</td>
        <td><a href="index.php?action=update&id='.$data["id"].'"><button class="btn btn-success">Modifica</button></a></td>
        <td><a href="index.php?action=utenti&delete='.$data["id"].'"><button class="btn btn-danger">Cancella</button></a></td>
    </tr>';
     }
     }

//modifica dati utente

public function modificaUtenteController(){

        $datiController = $_GET['id'];
        $responseDb = DATI::modificaUtenteModel($datiController, 'utenti');

        $id         = $responseDb['id'];
        $nome       = $responseDb['nome'];
        $email      = $responseDb['email'];
        $password   = $responseDb['password'];

        echo '
                    <input hidden value="'.$id.'" name="idUtente">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" value="'.$nome.'">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control"  value="'.$email.'" aria-describedby="emailHelp" name="mail">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" value="'.$password.'" class="form-control" name="password">
                    </div>

                    <button type="submit" name="aggiorna" class="btn btn-block btn-primary">Invia</button>';

}

//AGGIORNA I DATI UTENTE

public function aggiornaUtenteController(){

    if(isset($_POST['aggiorna'])){
        $securePassword = crypt($_POST['password'], '$5$q0BOeNCdrtpYeChR7ROQ3dvUTNPiWbhG8x7HSydU$');
        $datiController = array(
            "id" => $_POST["idUtente"],
            "nome" => $_POST["nome"],
            "email" => $_POST["mail"],
            "password" => $securePassword
        );

        $responseDb = DATI::aggiornaUtenteModel($datiController, 'utenti');

        if($responseDb == 'successo'){

            header('location:edit');
        }else{

            echo 'error';
        }

    }
}

//CANCELLARE I DATI

public function cancellaUtenteController(){

    if(isset($_GET['delete'])){

        $datiController = $_GET['delete'];

        $responseDB = Dati::cancellaUtenteModel($datiController, 'utenti');

        if($responseDB == 'successo'){

            header('location:utenti');

        }
    }

}

//Ajax: user validation
static public function userValidationController($validUser){

    $datiController = $validUser;
    $responseDb = Dati::userValidationModel($datiController, 'utenti');

if(!empty($responseDb['nome'])){
    echo 0;
}else{
    echo 1;
}
}

//Ajax: mail validation
    static public function mailValidationController($validMail){

        $datiController = $validMail;
        $responseDb = Dati::mailValidationModel($datiController, 'utenti');

        if(!empty($responseDb['email'])){
            echo 0;
        }else{
            echo 1;
        }
    }

}



