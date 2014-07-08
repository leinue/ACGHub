<?php 
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_ALL);//Deprecated

include('header.php');

session_start();

if($_SESSION['admin-login-id']!=1){
?>

<div class="row">

  <div class="col-md-6 col-md-offset-3" id="sign-col">
   
  <div id="login" class="auth">
  
  <div class="auth-head">
  <h1>登录</h1>
  </div>
  
  <div class="auth-form-body">
  
    <form class="form-horizontal" role="form" action="check.php" method="POST" name="login-form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
      <input type="email" name="mail" class="form-control" id="inputEmail3" placeholder="Email" value="<?php if (isset($_COOKIE['UserMail'])){echo $_COOKIE['UserMail'];} ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password"  name="password" maxlength="16" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> 记住我
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="login" class="btn btn-default">登录</button>
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