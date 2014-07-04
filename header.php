<?php 
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACGHub - 更好的发布创意</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="hubstyle.css">
    <link rel="stylesheet" href="signcss.css">
    <link rel="stylesheet" href="regcss.css">
    <link rel="stylesheet" href="aboutcss.css">
    <link rel="stylesheet" href="workscss.css">

	
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
  
    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-link"></span>ACGHub</a>

    <?php 
     //error_reporting(E_ALL ^ E_NOTICE);
     session_start();
     if($_SESSION['user-login-id']!=1){
    ?>
    <form class="navbar-form navbar-left">
        <a href="login.php"><button type="button" class="btn btn-default" >登录</button></a>
        <a href="reg.php"><button type="button" class="btn btn-default">注册</button></a>
    </form>

    <?php
    }
    else{
    ?>
    <ul class="nav navbar-nav navbar-left" >
        <li class="logout"><a href="checkout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
        <li class="setting"><a href="setting.php"><span class="glyphicon glyphicon-cog"></span></a></li>
        <li class="create"><a href="create.php"><span class="glyphicon glyphicon-plus"></span></a></li>
        <li class="user"><a href="user.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION['user-account']; ?></span></a></li>
    </ul>
    <?php
    }
    ?>

   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
    <ul class="nav navbar-nav" id="head_left">
        <li><a href="index.php">Home</a></li>
        <li><a href="works.php">Works</a></li>
        <li><a href="about.php">关于</a></li>
      </ul>
    </div>
  </div>
</nav>
</header>