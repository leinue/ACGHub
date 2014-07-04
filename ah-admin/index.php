<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['admin-login-id']!=1){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理入口</title>


<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="../signcss.css">

</head>

<body>

<div class="row">

  <div class="col-md-6 col-md-offset-3" id="sign-col">
   
  <div id="login" class="auth">
  
  <div class="auth-head">
  <h1>管理员登录</h1>
  </div>
  
  <div class="auth-form-body">
  
    <form class="form-horizontal" role="form" action="login.php" method="POST" name="login-form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
      <input type="email" name="mail" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
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
header("Location:admin.php");
exit;
}
?>

</body>
</html>