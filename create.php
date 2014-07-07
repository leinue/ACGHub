<?php 
include('header.php');
include('fun/mysql.php');
connect_mysql();
 ?>

<?php 
     $sql="SELECT `checked` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
     echo $sql;
     $result=mysql_query($sql);
     if($_SESSION['user-login-id']==1){
      if($res!=false)
        $row=mysql_fetch_row($result);
        echo $row[0];
        if($row==1){
?>

<div class="create-body">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">新建一个项目</h3>
  </div>
  <div class="panel-body">
    <form class="form-create">
<input type="text" class="form-control" placeholder="目录名">
<span class="help-block">不妨起一个简短可记的名字</span>

<textarea class="form-control" rows="3" placeholder="描述"></textarea>
<span class="help-block">可选</span>
<div class="radio">
  <label>
    <input type="radio" name="public"value="public" checked>
    <span class="glyphicon glyphicon-retweet"> 公开</span>
    <span class="help-block">每个人都可以看到这条目录,并且可以关注/修改</span>
  </label>
</div>

<div class="radio">
  <label>
    <input type="radio" name="private"value="private">
    <span class="glyphicon glyphicon-lock"> 私有</span>
    <span class="help-block">由你选择谁可以关注/修改这条目录</span>
  </label>
</div>

<button type="button" class="btn btn-success">确认创建</button>
</form>
  </div>
</div>
</div>
<?php
        }
        else{
          $sql="SELECT * FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
          $res=mysql_query($sql);
          if($res!=false){
            $row=mysql_fetch_row($res);
            $_SESSION['regurl']="http://localhost/acghub/emailcheck.php?u=".$row[0];
          }

?>
      <div class="e-check-body">

      <h2><a href="<?php echo $_SESSION['regurl']; ?>">请点击进行邮箱验证</a></h2>

      </div>
<?php
        }
?>

<?php
}
else
{
  header("location:index.php");
}
?>

<?php include('footer.php'); ?>