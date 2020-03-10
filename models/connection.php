<?php

class Connection{

    public static function connect(){

        $link = new PDO('mysql:host=localhost;dbname=nome_del_tuo_db', 'nome_utente','password_db');
        return $link;
        //var_dump($link);
        //echo $link;
    }

}

$test = new Connection();
$test->connect();