<?php
include('header.php');
include('fun/mysql.php');
include('fun/function.php');

connect_mysql();

if($_SESSION['user-login-id']==1){

$user_id=test_input(trim($_GET['u']));
$ver_method=test_input(trim($_GET['method']));

if($ver_method=="reg"){
$sql = "select *from `acghub_member` where `checked`=0 and `id`='".$user_id."'";
$result=mysql_query($sql);//id
$row = mysql_fetch_array($result); 
if($row){
	$sql = "UPDATE `acghub_member` SET `checked`=1 where `id`=$user_id";
    $result=mysql_query($sql);
    if(mysql_affected_rows()!=-1){
    	

?>

    <div class="e-check-body">
    <div class="panel panel-default">
    <div class="panel-heading">
    <h3 class="panel-title">您已验证成功</h3>
    </div>
    <div class="panel-body">
    <a href="index.php"><p>点击这里返回主页</p></a>
    </div>
    </div>
    </div>

<?php

    }
    else{
?>
    
    <div class="e-check-body">
    <div class="panel panel-default">
    <div class="panel-heading">
    <h3 class="panel-title">验证失败,数据库出错,请稍后再试</h3>
    </div>
    <div class="panel-body">
    <a href="index.php"><p>点击这里返回主页</p></a>
    </div>
    </div>
    </div>

<?php

    }
}
}
   if($ver_method="altmail"){
    $newmail=test_input($_GET['newmail']);
    $sql="UPDATE `acghub_member` SET `email`='".$newmail."'' WHERE `email`='".$_SESSION['user-account']."'";
    $res_alt=mysql_query($sql)
    if($res_alt!=false){
        $_SESSION['user-account']=$newmail;
?>

    <div class="e-check-body">
    <div class="panel panel-default">
    <div class="panel-heading">
    <h3 class="panel-title">变更成功</h3>
    </div>
    <div class="panel-body">
    <a href="index.php"><p>点击这里返回主页</p></a>
    </div>
    </div>
    </div>

<?php
        }
        else{
?>
    <div class="e-check-body">
    <div class="panel panel-default">
    <div class="panel-heading">
    <h3 class="panel-title">验证失败,数据库出错,请稍后再试</h3>
    </div>
    <div class="panel-body">
    <a href="index.php"><p>点击这里返回主页</p></a>
    </div>
    </div>
    </div>

<php?
        }
   }

}
else{
	header('location:index.php');
}
}
?>

<?php include('footer.php'); ?>