<meta charset="utf-8">
<?php
include("../fun/function.php");
include("../fun/mysql.php");
connect_mysql();

$admin_account=test_input($_POST['mail']);
$admin_password=md5(test_input($_POST['password']));

$sql_admin_login_verify="SELECT *FROM `acghub_member` WHERE email='$admin_account' and `password`='$admin_password'";
$res=mysql_query($sql_admin_login_verify);
if($res!=false){
	$row=mysql_fetch_row($res);
	$admin_id=$row[0];

	if($admin_id){
		$sta=GetStatus(GetUid($admin_account));
		if($sta=="admin"){
			session_start();
	        $_SESSION['admin-login-id']=1;
	        $_SESSION['admin-pw']=$admin_password;
	        $_SESSION['admin-account']=$admin_account;
	        header("Location:admin.php");
		}else{
			header("Location:../index.php");}
	}else{
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">登录失败</h3>
  </div>
  <div class="panel-body">
    帐号不存在或密码错误.<a href="index.php">点击返回</a>
  </div>
</div>
<?php
	}
}else{
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">登录失败</h3>
  </div>
  <div class="panel-body">
    数据库错误.<a href="index.php">点击返回</a>
  </div>
</div>
<?php
}

?>