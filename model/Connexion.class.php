<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'aeek_kassere');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

function bdd(){
    try{
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD,array(
            PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'UTF8'",
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ));
    }  catch (Exception $ex){
        die("Erreur :".$ex->getMessage());
        exit();
    }
    return $db;
}