<?php
session_start(); 
session_destroy();
session_unset();
setcookie('admin-login-id','',time()-3600);
setcookie('admin-pw','',time()-3600);
setcookie('admin-account','',time()-3600);
setcookie('user-login-id','',time()-3600);
setcookie('user-account','',time()-3600);
setcookie('user-pw','',time()-3600);
header("Location:index.php");
exit;
?>