<?php 
error_reporting(E_ALL ^ E_NOTICE);
include('header.php');
session_start();
if($_SESSION['user-login-id']!=1){
?>

<div class="row">

<div class="col-md-6 col-md-offset-3" id="reg-col">

  <div id="reg" class="reg-auth">

    <div class="reg-head">
    <h1>注册</h1>
    </div>

<div class="reg-form-body">

<form class="form-horizontal" role="form">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="请输入您的昵称">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="请输入您的邮箱">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="请输入您的密码">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
     <h4>在您点击注册之后，我们将发送一封确认邮件，请注意查收</h4>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <button type="submit" class="btn btn-default" id="reg-button">注册</button>
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