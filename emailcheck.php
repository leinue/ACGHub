<?php
include('header.php');
include('fun/mysql.php');
conncet_mysql();

$sql="select *from acghub_member where checked=0 and md5(md5(id))='".trim($_GET['u']."'");
$result=mysql_query($sql);//id
while($row=mysql_fetch_array($result)){
	/*UPDATE `acghub_member` SET `id`=[value-1],`name`=[value-2],
	`email`=[value-3],`password`=[value-4],`_date`=[value-5],`sta`=[value-6],`checked`=[value-7] WHERE 1*/
	$sql="UPDATE `acghub_member` SET `checked`=1 where id=".$row['id'];
	$result=mysql_query($sql);
	$email=$row['email'];
}

?>

<div class="e-check-body">
    <h2>您已验证成功</h2>
    <a href="#"><p>点击这里返回主页</p></a>
</div>

<?php include('footer.php'); ?>