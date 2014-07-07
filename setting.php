<?php 
include('header.php'); 
include('fun/mysql.php');
?>

<?php 
     if($_SESSION['user-login-id']==1){

      connect_mysql();

      $sql="SELECT `age`, `sex`, `website`,`location` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."' ";
      $res=mysql_query($sql);
      if($res!=false)
        $row=mysql_fetch_row($res);
        //$row[0]->age
        //$row[1]->sex 1->boy 2->girl ->3 futa 0->none
        //$row[2]->website
        //$row[3]->location
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

<form role="form" name"profile" class="update-form" action="setting.php" method="POST">

  <div class="form-group">
    <label>姓名</label>
    <input type="text" class="form-control" placeholder="输入姓名" name="username" value="<?php echo $_SESSION['user-name']; ?>">
  </div>
  <div class="form-group">
    <label>网址</label>
    <input type="text" class="form-control" placeholder="输入网址" name="website" value="<?php echo $row[2]; ?>">
  </div>
  <div class="form-group">
    <label>地址</label>
    <input type="text" class="form-control" placeholder="输入地址" name="location" value="<?php echo $row[3]; ?>">
  </div>
  <div class="form-group">
    <label>年龄</label>
    <input type="text" class="form-control" placeholder="输入年龄" name="age" value="<?php echo $row[0]; ?>">
  </div>

  <?php
  if($row[1]==1){

  ?>
  <div class="form-group">
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="checked"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 不明生物体
  </label>
  </div>
  <?php
  }
  elseif($row[1]==2){
  ?>

  <div class="form-group">
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked="checked"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 不明生物体
  </label>
  </div>

  <?php
  }
  elseif($row[1]==3){
  ?>
  <div class="form-group">
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4" checked="checked"> 不明生物体
  </label>
  </div>
  <?php
  }
  elseif($row[1]==0){
  ?>
  <div class="form-group">
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 不明生物体
  </label>
  </div>  
  <?php
  }
  ?>


  <button type="button" class="btn btn-default" name="update">更新信息</button>
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

  <div class="alert alert-info" role="alert">现在的邮箱:<?php echo $_SESSION['user-account']; ?></div>

  <div class="mail-col">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="请输入新邮箱">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">变更邮箱</button>
      </span>
    </div><!-- /input-group -->
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

  </div>
  </div>

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">粉丝</h3>
  </div>
  <div class="panel-body">
  	
  	

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

 
  </div>


  </div>
  </div>
  <div class="tab-pane" id="info">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">我的私信</h3>
  </div>
  <div class="panel-body">

  	<div class="panel panel-default">
      <div class="panel-body">

     <div class="friends-photo">
      <a href="#"><img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50"></a>
      </div>

      <div class="friends-detail">
      <p>与 <a href="#">蛤蛤蛤</a> 的最后一次对话</p>
      <p id="#sys-info-icon"><span class="glyphicon glyphicon-chevron-left"></span>丧心病狂<span class="glyphicon glyphicon-chevron-right"></span></p>
      </div>
      </div>

    </div>

  </div>
  </div> 	

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">系统通知</h3>
  </div>
  <div class="panel-body">
  	<div class="panel panel-default">
      <div class="panel-body"  id="sys-info-icon">
      <span class="glyphicon glyphicon-warning-sign"></span> [系统通知]

      <p>werewrewrewewerwewerrwrwwerwerrwe</p>
      <p>2014-01-01</p>
      </div>
    </div>

  	<div class="panel panel-default">
      <div class="panel-body">
      
      </div>
    </div>

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