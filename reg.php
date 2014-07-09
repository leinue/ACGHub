<?php 
error_reporting(E_ALL ^ E_NOTICE);
include('header.php');
include('fun/mysql.php');
include('fun/function.php');
session_start();

$username=$_POST['name'];
$usermail=$_POST['email'];
$userpw=$_POST['password'];

connect_mysql();
if(trim($username)<>"" and trim($usermail)<>"" and $userpw<>""){
    if(checkemail($usermail)==false){
      if(connect_mysql()){
      $sql="INSERT INTO `acghub_member`(`name`,`email`,`password`,`_date`,`sta`,checked,age,sex,`website`,`location`,`message`,`friends`,`photo`)
       VALUES('".$username."','".$usermail."','".md5($userpw)."','".$_server['server_time']."','user',0,0,0,'www.acghub.com','tianchao','0','0','0')";
      if(mysql_query($sql)){
        $reg_url="http://localhost/emailcheck.php?u=".mysql_insert_id()."?method=reg";
        $content="<a href=\"".$reg_url."\">欢迎注册ACGHub,请点击这里进行激活帐号</a>";
        mail($usermail,"感谢注册ACGHub",$content);

        $_SESSION['user-login-id']=1;
        $_SESSION['user-account']=$usermail;
        $_SESSION['user-pw']=$userpw;
        $sql="SELECT `name` FROM `acghub_member` WHERE `email`='$usermail' ";//取用户名
        $res_name=mysql_query($sql);
        $row_name=mysql_fetch_row($res_name);
        $_SESSION['user-name']=$row_name[0];
        //header("Location:index.php");
?>

     <div class="reg-form-body">
      <div class="alert alert-warning alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <strong>提醒!</strong> 注册成功!页面即将跳转</div>
       <script language='javascript'>alert("注册成功");</script>
     </div>

<?php
      }
      else{
      die(mysql_error());
?>

<div class="reg-form-body">
  <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>提醒!</strong> 注册失败!请稍后再试! </div>
</div>

<?php
      }
      }
      else{
        die(mysql_error());
      }
    }
    else{
?>

<div class="reg-form-body">
  <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>提醒!</strong> 你的邮箱已被注册! </div>
</div>
<?php
    }
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
      <button type="submit" name="reg" class="btn btn-default" id="reg-button" >注册</button>
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