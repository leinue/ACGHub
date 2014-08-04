<?php
include_once("../fun/function.php");
include_once("../fun/mysql.php");
connect_mysql();
session_start();
if($_SESSION['admin-login-id']==1){
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACGHub - 管理中心</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/hubstyle.css">
    <link rel="stylesheet" href="style/style.css">

	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
  
<body>

<header>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
  
    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-link"></span>ACGHub-管理中心</a>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
    <ul class="nav navbar-nav navbar-left" >
        <li class="logout"><a href="logout.php">退出登录</a></li>
    </ul>
    <ul class="nav navbar-nav" id="head_left">
        <li><a href="res.php">资源管理</a></li>
        <li><a href="user.php">用户管理</a></li>
        <li><a href="setting.php">网站设置</a></li>
      </ul>
    </div>
  </div>
</nav>
</header>

<?php
}
else{
    header("Location:index.php");
    exit;
}
?>