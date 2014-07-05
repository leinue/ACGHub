<?php include('header.php'); ?>

<?php 
     if($_SESSION['user-login-id']==1){
?>

<div class="user-per">

<div class="user-info">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">菜单</h3>
  </div>
  <div class="panel-body">

  <ul class="nav nav-pills nav-stacked">
  <li class="active"><a href="#profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-phone"></span> 基本资料</a></li>
  <li><a href="#account" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-wrench"></span> 帐户设置</a></li>
  <li><a href="#mail" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> 邮箱设置</a></li>
  <li><a href="#friends" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-heart-empty"></span> 好友</a></li>
  <li><a href="#info" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> 信息中心</a></li>
  </ul>

  </div>
</div>
</div>

<div class="res-info">
<div class="tab-content">
  <div class="tab-pane active in" id="profile">
  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">基本资料</h3>
  </div>
  <div class="panel-body">
  <div class="row">
  <div class="col-md-8">
  <h4>修改头像</h4>

  <div class="setting-photo">
  <img alt="ivy" src="https://avatars3.githubusercontent.com/u/2469688?s=140" height="70" width="70">
  </div>

  <div class="setting-button-upload">
   <button type="button" class="btn btn-default">上传新头像</button>
   <span class="help-block">请上传具有标志性的头像</span>
  </div>
  </div>
</div>
<div class="row">

  <div class="col-md-8">

<form role="form" class="update-form">

  <div class="form-group">
    <label>姓名</label>
    <input type="text" class="form-control" placeholder="输入姓名">
  </div>
  <div class="form-group">
    <label>邮箱</label>
    <input type="email" class="form-control" placeholder="输入邮箱">
  </div>
  <div class="form-group">
    <label>网址</label>
    <input type="text" class="form-control" placeholder="输入网址">
  </div>
  <div class="form-group">
    <label>地址</label>
    <input type="text" class="form-control" placeholder="输入地址">
  </div>

  <button type="submit" class="btn btn-default">更新信息</button>
</form>

  </div>
</div>

</div>
</div></div>

  <div class="tab-pane" id="account">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">帐户设置</h3>
  </div>
  <div class="panel-body">
   <form>
  	<div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="输入旧密码">
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="输入新密码">
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="确认新密码">
    </div>
    </div>
    <div class="form-group" id="update-pw">
    <button type="button" class="btn btn-default">更新密码</button></div>
  </form>
  </div>
  </div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">删除帐户</h3>
  </div>
  <div class="panel-body">
    <div class="alert alert-warning" role="alert">您的数据将会被完全删除,无法恢复!</div>
    <button type="button" class="btn btn-danger">确认删除帐户</button>  
    <div class="checkbox">
    <label>
      <input type="checkbox">确认删除请勾选我
    </label>
  </div>
  </div>
</div>

  </div>

  <div class="tab-pane" id="mail">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">邮箱设置</h3>
  </div>
  <div class="panel-body">

  <div class="mail-col">

  597055914@qq.com

  </div>

  </div>
  </div>

  </div>
  <div class="tab-pane" id="friends">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">关注</h3>
  </div>
  <div class="panel-body">
  	
  </div>
  </div>

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">粉丝</h3>
  </div>
  <div class="panel-body">
  	
  	<div class="friends-info">

  	<div class="f-i-left">
  	  <div class="panel panel-default">
     <div class="panel-body">

      <div class="friends-photo">
<img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
      </div>

      <div class="friends-detail">
      <p><a href="#">蛤蛤蛤</a></p>
      <p><a href="#">私信</a></p>
      </div>

    </div>
     </div>
  	</div>

    <div class="f-i-mid">

  	  <div class="panel panel-default">
     <div class="panel-body">

      <div class="friends-photo">
<img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
      </div>

      <div class="friends-detail">
      <p><a href="#">蛤蛤蛤</a></p>
      <p><a href="#">私信</a></p>
      </div>

    </div>
     </div>

  	</div>

  	<div class="f-i-right">

  	  <div class="panel panel-default">
     <div class="panel-body">

      <div class="friends-photo">
<img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
      </div>

      <div class="friends-detail">
      <p><a href="#">蛤蛤蛤</a></p>
      <p><a href="#">私信</a></p>
      </div>

    </div>
     </div>

  	</div>

  </div>
  </div>


  </div>
  </div>
  <div class="tab-pane" id="info">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">信息中心</h3>
  </div>
  <div class="panel-body">
  	
  </div>
  </div> 	

  </div>
</div>

</div>

</div>

<?php
}
else
{
  header("location:index.php");
}
?>

<?php include('footer.php'); ?>