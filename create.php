<?php include('header.php'); ?>

<?php 
     if($_SESSION['user-login-id']==1){
?>

<div class="create-body">

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

<?php
}
else
{
  header("location:index.php");
}
?>

<?php include('footer.php'); ?>