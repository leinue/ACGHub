<?php 
error_reporting(E_ALL ^ E_NOTICE);
include('header.php');
include('fun/mysql.php');
session_start();

$username=$_POST['name'];
$usermail=$_POST['email'];
$userpw=$_POST['password'];

connect_mysql();
if(trim($username)<>"" and trim($usermail)<>"" and $userpw<>""){
    if(checkemail($usermail)==false){
      if(connect_mysql()){
      $sql="INSERT INTO `acghub_member`(`name`,`email`,`password`,`_date`,`sta`,checked) VALUES('".$username."','".$usermail."','".md5($userpw)."','"."2010','user',0)";
      echo $sql;
      if(mysql_query($sql)){
        echo '注册成功!';

        $reg_url="http://localhost/emailcheck.php?u=".mysql_insert_id();
        $content="<a href=\"".$reg_url."\">欢迎注册ACGHub,请点击这里进行注册</a>";
        mail($usermail,"感谢注册ACGHub",$content);
?>

<?php
      }
      else{
      die();
      echo '注册失败';
      }
      }
      else{
        die();
      }
    }
    else{
      echo '您的邮箱已被注册';
    }
}

function checkemail($email_checked){
    $sql = "select count(*) from `acghub_member` where email='".$email_checked."'";
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      return $row[0];
    }
    else{return false;}
}
?>

<?php
if($_SESSION['user-login-id']!=1){
?>

<div class="row">

<div class="col-md-6 col-md-offset-3" id="reg-col">

  <div id="reg" class="reg-auth">

    <div class="reg-head">
    <h1>注册</h1>
    </div>

<div class="reg-form-body">

<form class="form-horizontal" role="form" method="POST" action="reg.php">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" placeholder="请输入您的昵称">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="请输入您的邮箱">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="请输入您的密码">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
     <h4>在您点击注册之后，我们将发送一封确认邮件，请注意查收</h4>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <button type="submit" name="reg" class="btn btn-default" id="reg-button">注册</button>
    </div>
  </div>
</form>

</div>

</div>

</div>
</div>

<?php
}
else{
  header("location:index.php");
}
?>

<?php include('footer.php'); ?>