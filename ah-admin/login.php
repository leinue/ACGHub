<meta charset="utf-8">
<?php

$user="admin@admin.com";
$password="admin";

if(trim($_POST['mail'])==$user && trim($_POST['password'])==$password){
	session_start();
	$_SESSION['admin-login-id']=1;
	$_SESSION['admin-pw']=$password;
	header("Location:admin.php");
	exit;
}
else
{
  echo "用户名或密码错误";
}

?>