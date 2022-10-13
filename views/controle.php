<?php
$slug = trim(utf8_decode(trim(substr($_SERVER["REQUEST_URI"], strlen(dirname($_SERVER["SCRIPT_NAME"]))))), "/");

$file = explode('/',$slug);
$filesName = strtolower(end($file));

if(!file_exists('controller/'.$filesName.'.php')){
    header('location:'.$domaine.'/error');
}else{
    require_once 'controller/'.$filesName.'.php';
}
