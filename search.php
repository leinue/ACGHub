<?php
include('header.php');

connect_mysql();

    $sql="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
    $res=getone($sql);

    $res_searched=test_input($_POST['searchform']);

if($res_searched!=""){
    $path="userpro/".$res;
    $dir=@opendir($path);

    $found=false;

    while(($file=readdir($dir))!=false){
    	if($file==$res_searched){
        $found=true;
        
?>
   <div class="e-check-body">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">寻找成功</h3>
      </div>
    <div class="panel-body">
    <a href="#"><?php echo $file; ?></a>
    </div>
    </div>
   </div>

<?php
     
    	}
    	elseif(!$found){

?>
   <div class="e-check-body">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">系统出错</h3>
      </div>
    <div class="panel-body">
    没有找到文件<a href="index.php">点击返回</a>
    </div>
    </div>
   </div>

<?php
     
    	}
    }

    closedir($dir);
}
else{
?>
   <div class="e-check-body">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">系统出错</h3>
      </div>
    <div class="panel-body">
    查询内容不能为空<a href="index.php">点击返回</a>
    </div>
    </div>
   </div>
<?php
}

include('footer.php');
?>