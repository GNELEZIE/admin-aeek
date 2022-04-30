<?php
if(isset($_COOKIE['aeekcookie'])) {
    setcookie('aeekcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
}
unset($_SESSION['useraeek']);
header('location:'.$domaine_admin.'/login');
exit();