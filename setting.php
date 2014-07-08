<?php 
include('header.php'); 
include('fun/mysql.php');
?>

<?php 
connect_mysql();
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
     connect_mysql();
     if($_SESSION['user-login-id']==1){

      if($_POST['upload']=="upload"){
        
      }

      if($_POST['update']=="update"){
        $age=test_input($_POST['age']);
        $location=test_input($_POST['location']);
        $website=test_input($_POST['website']);
        $sex=test_input($_POST['sex']);

        //UPDATE `acghub_member` SET `age`=[value-8],`sex`=[value-9],`website`=[value-10],`location`=[value-11] WHERE `email`=
        $sql = "UPDATE `acghub_member` SET `age`=".$age.",`sex`=".$sex.",`website`='".$website."',`location`='".$location."' WHERE `email`='".$_SESSION['user-account']."'";
        $result=mysql_query($sql);
        echo mysql_error();
        if($result!=false){
          if(mysql_affected_rows()==-1){
            echo '修改资料失败!';
          }
          else{
            echo '修改资料成功!';
          }

        }

      }

      if($_POST['update-pw']=="update-pw"){
        $oldpw=test_input($_POST['oldpw']);
        $newpw=test_input($_POST['newpw']);
        $connewpw=test_input($_POST['confirm-newpw']);

        if($oldpw<>"" && $newpw<>"" && $connewpw<>""){
          $sql = "SELECT `password` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
          $res=mysql_query($sql);
          if($res!=false){
            $row=mysql_fetch_row($res);
            if($row[0]==$oldpw){
              if($newpw==$connewpw){
                $sql="UPDATE `acghub_member` SET `password`='' WHERE `email`='".$_SESSION['user-account']."'";
                $res_pw=mysql_query($sql);
                if($res_pw!=false){
                  if(mysql_affected_rows()==-1){
                    echo '更新失败';
                  }
                  else{
                    echo '修改资料成功';
                  }
                }
                else{
                  echo '数据库出错';
                }
              }
              else{
                echo "新密码确认错误";
              }
            }
            else{
              echo '旧密码不符合';
            }
          }
          else{
            echo '数据库出错';
          }

        }
        else{
          echo '密码不能为空';
        }
      }

      if($_POST['submit-delete']=="submit-delete"){
        $con_del=test_input($_POST['confirm-delete']);
        if(isset($con_del)){
          $sql="DELETE FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
          $res_delete=mysql_query($sql);
          if($res_delete!=false){
            if(mysql_affected_rows()==-1){
            echo '删除失败';
          }
          else{
            echo '删除成功';
          }
        }
        else{echo '数据库出错';}
        }
        else{
          echo '没有选中确认框';
        }
      }

      $sql="SELECT `age`, `sex`, `website`,`location` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."' ";
      $res=mysql_query($sql);
      if($res!=false)
        $row=mysql_fetch_row($res);
        //$row[0]->age
        //$row[1]->sex 1->boy 2->girl ->3 futa 0->none
        //$row[2]->website
        //$row[3]->location
?>

<script type="text/javascript">
  function preview(imgfile){
    doucument.getElementById("pic").src=imgfile.value;
  }
  var right_type=new Array(".jpg",".gif",".bmp",".png");

  function checkimgtype(fileURL){
    var right_typelen=right_type.length;
    var imgURL=fileURL.tolowercase();
    var postfixlen=imrURL.length;
    var len4=imgURL.substring(postfixlen-4,postfixlen);
    var len5=imgURL.substring(postfixlen-5,postfixlen);
    for(i=0;i<right_typelen;i++){
      if((len4==right_type[i])||(len5==right_type[i])){
        return true;
      }
    }
  }

  function sub(o){
    if(o.upload_file.value==""){
      alert("请选择一个图片文件\n");
      return false;
    }
    if(checkimgtype(o.upload_file.value)){
      perimg(o.upload_file.value);
      return true;
    }
    else{
      alert("你选择的文件格式不正确\n");
      o.upload_file.focus();
      return false;
    }
  }
</script>
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
  <form enctype="multipart/form-data" action="setting.php" onsubmit="return sub(this)" name="uploadform" method="post">
  <input type="file" name="upload_photo" onchange="if(checkimgtype(this.value))">
  <input name="action" type="hidden" value="upload"/>
  <div class="setting-photo">
  <img id="pic" alt="<?php echo $_SESSION['user-account']; ?>" src="https://avatars3.githubusercontent.com/u/2469688?s=140" height="70" width="70">
  </div>

  <div class="setting-button-upload">
   <button type="submit" name="upload" value="upload" class="btn btn-default">上传新头像</button>
   <span class="help-block">大小最好为为250x250,支持的格式有.jpg|.gif</span>
  </div>
  </form>
  </div>
</div>
<div class="row">

  <div class="col-md-8">

<form role="form" name="profile" class="update-form" action="setting.php" method="POST">

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
  <input type="radio" name="sex" id="inlineRadio1" value="1" checked="checked"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio2" value="2"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio4" value="3"> 不明生物体
  </label>
  </div>
  <?php
  }
  elseif($row[1]==2){
  ?>

  <div class="form-group">
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio1" value="1"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio2" value="2" checked="checked"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio4" value="0"> 不明生物体
  </label>
  </div>

  <?php
  }
  elseif($row[1]==3){
  ?>
  <?php
  }
  elseif($row[1]==0){
  ?>
  <div class="form-group">
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio1" value="1"> 可爱的男孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio2" value="2"> 帅气的女孩子
  </label>
  <label class="radio-inline">
  <input type="radio" name="sex" id="inlineRadio4" value="0" checked="checked"> 不明生物体
  </label>
  </div>  
  <?php
  }
  ?>

  <button type="submit" class="btn btn-default" name="update" value="update">更新信息</button>
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
   <form method="post" action="setting.php">
  	<div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" name="oldpw" id="inputPassword3" placeholder="输入旧密码">
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" name="newpw" id="inputPassword3" placeholder="输入新密码">
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" name="confirm-newpw" id="inputPassword3" placeholder="确认新密码">
    </div>
    </div>
    <div class="form-group" id="update-pw">
    <button type="submit" name="update-pw" value="update-pw" class="btn btn-default">更新密码</button></div>
  </form>
  </div>
  </div>

<div class="panel panel-default">
 <form method="post" name="delete-account" action="setting.php">
  <div class="panel-heading">
    <h3 class="panel-title">删除帐户</h3>
  </div>
  <div class="panel-body">
    <div class="alert alert-warning" role="alert">您的数据将会被完全删除,无法恢复!</div>
    <button type="submit" name="submit-delete" value="submit-delete" class="btn btn-danger">确认删除帐户</button>  
    <div class="checkbox">
    <label>
      <input name="confirm-delete" value="confirm-delete" type="checkbox">确认删除请勾选我
    </label>
  </div>
  </div>
  </form>
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
      <div class="panel-body">m
      
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