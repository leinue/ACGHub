<meta charset="utf-8">
<?php
include('header.php');

connect_mysql();

$user=$_POST['mail'];
$password=$_POST['password'];

setcookie("UserMail",$user);

$sql="select *from acghub_member where email='".$user."' and password='".md5($password)."'";
$res=mysql_query($sql);
if($res!=false){
	$row=mysql_fetch_row($res);
	$user_id=$row[0];

	if($user_id){
		session_start();
	    $_SESSION['user-login-id']=1;
	    $_SESSION['user-account']=$user;
	    $_SESSION['user-pw']=$password;
	    $sql="SELECT `name` FROM `acghub_member` WHERE `email`='$user' ";//取用户名
	    $res_name=mysql_query($sql);
	    $row_name=mysql_fetch_row($res_name);
	    $_SESSION['user-name']=$row_name[0];
	    header("Location:index.php");
	    exit;
	}
	else{
?>

   <div class="e-check-body">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">登录失败</h3>
      </div>
    <div class="panel-body">
    帐号不存在或密码错误.<a href="login.php">点击返回</a>
    </div>
    </div>
   </div>

<?php
	}

}
else{
?>

<?php
}

include('footer.php');
?>