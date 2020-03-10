<?php
require_once "../../controllers/controller.php";
require_once "../../models/crud.php";

class Ajax{

    public $validUser;
    public $validMail;

    public function validUserAjax(){
        $dati = $this->validUser;

        $response = MvcController::userValidationController($dati);
        //echo $dati;
        echo $response;
    }

    public function validMailAjax(){
        $dati = $this->validMail;

        $response = MvcController::mailValidationController($dati);
        //echo $dati;
        echo $response;
    }
}

if(isset($_POST['userValidation'])) {
    $validationUser = new Ajax();
    $validationUser->validUser = $_POST['userValidation'];
    $validationUser->validUserAjax();
}

if(isset($_POST['mailValidation'])) {
    $validationMail = new Ajax();
    $validationMail->validMail = $_POST['mailValidation'];
    $validationMail->validMailAjax();
}