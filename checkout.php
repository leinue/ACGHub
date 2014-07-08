<?php
function checkout(){
	session_start(); 
    session_destroy();
    session_unset();
    setcookie('user-login-id','',time()-3600);
    setcookie('user-account','',time()-3600);
    setcookie('user-pw','',time()-3600);
    header("Location:index.php");
    exit;
}
checkout();
?>