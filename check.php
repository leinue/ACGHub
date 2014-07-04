<meta charset="utf-8">
<?php

$user="admin@admin.com";
$password="admin";

if(trim($_POST['mail'])==$user && trim($_POST['password'])==$password){
	session_start();
	$_SESSION['user-login-id']=1;
	$_SESSION['user-account']=$user;
	$_SESSION['user-pw']=$password;
	header("Location:index.php");
	exit;
}
else
{
  echo "用户名或密码错误";
}

?>