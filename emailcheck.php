<?php
include('header.php');
include('fun/mysql.php');

connect_mysql();

if($_SESSION['user-login-id']==1){

$user_id=trim($_GET['u']);
$sql = "select *from `acghub_member` where `checked`=0 and `id`='".$user_id."'";
$result=mysql_query($sql);//id
$row = mysql_fetch_array($result); 
if($row){
	$sql = "UPDATE `acghub_member` SET `checked`=1 where `id`=$user_id";
    $result=mysql_query($sql);
    if(mysql_affected_rows()!=-1){
    	

?>
    <div class="e-check-body">
    <h2>您已验证成功</h2>
    <a href="index.php"><p>点击这里返回主页</p></a>
    </div>

<?php

    }
    else{
?>
    
    <div class="e-check-body">
    <h2>验证失败,数据库出错,请稍后再试</h2>
    <a href="index.php"><p>点击这里返回主页</p></a>
    </div>

<?php

    }
}
}
else{
	header('location:index.php');
}
?>

<?php include('footer.php'); ?>