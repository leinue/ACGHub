<?php 
include('header.php'); 
?>

<?php 
connect_mysql();

     if($_SESSION['user-login-id']==1){

      if($_POST['upload']=="upload"){
        $sql_id="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
        $userid=getone($sql_id);
        if($userid!=false){

          $upic=UploadPic(2000000,"uploadimg/".$userid."/",0,1/2,"upload_photo");
          switch (upic) {
            case -1:
              echo '图片不存在!';
              break;
            case -2:
              echo "文件太大!";
              break;
            case -3:
              echo "文件类型不符!";
              break;
            case -4:
              echo "同名文件已经存在了";
              break;
            case -5:
              echo "移动文件出错";
              break;
            default:
              $sql_org="SELECT `photo` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
              $picfile=GetPhoDir($sql_org);
              if($picfile!=false){
                @unlink ($picfile);
              }

              $sql_upic="UPDATE `acghub_member` SET `photo`='".$upic."' WHERE `email`='".$_SESSION['user-account']."'";
              $res_upic=mysql_query($sql_upic);
              if($res_upic!=false){
                if(mysql_affected_rows()){
                  echo "上传成功";
                }else{echo "更新失败";}
              }
              else{echo '数据库出错';}

          }

        }else{echo '数据库出错';}
      }

      if($_POST['update']=="update"){
        $age=test_input($_POST['age']);
        $location=test_input($_POST['location']);
        $website=test_input($_POST['website']);
        $sex=test_input($_POST['sex']);

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
            if($row[0]==md5($oldpw)){
              if($newpw==$connewpw){
                $sql="UPDATE `acghub_member` SET `password`='".md5($newpw)."' WHERE `email`='".$_SESSION['user-account']."'";
                $res_pw=mysql_query($sql);
                if($res_pw!=false){
                  if(mysql_affected_rows()==-1){
                    echo '更新失败';
                  }
                  else{
                    echo '修改密码成功';
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
        $checkbox_con_del=test_input($_POST['confirm-delete']);
        if($checkbox_con_del==9){
          $sql="DELETE FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
          $res_delete=mysql_query($sql);
          if($res_delete!=false){
            if(mysql_affected_rows()==-1){
            echo '删除失败';
          }
          else{
            $sql_id="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
            $res=mysql_query($sql_id);
            if($res!=false){
              $row=mysql_fetch_row($res);
              delsvndir("userpro/".$row[0]);
              echo '删除成功';
              session_start(); 
              session_destroy();
              session_unset();
              setcookie('user-login-id','',time()-3600);
              setcookie('user-account','',time()-3600);
              setcookie('user-pw','',time()-3600);
              header("Location:index.php");
              exit;
            }
            else{echo '数据库出错';}
          }
        }
        else{echo '数据库出错';}
        }
        else{
          echo '没有选中确认框';
        }
      }

      if($_POST['submit-newemail']=="submit-newemail"){
        $neweamil=test_input($_POST['newemail']);
        if(checkemail($neweamil)!=false){
        $sql="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
        $con_id=mysql_query($sql);
        if($con_id!=false){
          $alt_url="http://localhost/acghub/emailcheck.php?u=".$con_id[0]."?method=altmail"."?newmail=".$neweamil;
          $alt_content="<a href=\"".$alt_url."\">欢迎注册ACGHub,请点击这里进行激活帐号</a>";
          mail($_SESSION['user-account'],"ACGHub - 变更邮箱",$alt_content);
          echo '邮件已发送到新邮箱';
        }
        else{
          echo '数据库出现问题';
        }
      }
      else{
        echo '邮箱帐号重复';
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
  <li><a href="#friends" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-heart-empty"></span> 资源信息</a></li>
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

  <form enctype="multipart/form-data" method="post" name="upform" action="setting.php">
  <input type="file" name="upload_photo">
  <div class="setting-photo">
  <img id="pic" alt="<?php echo $_SESSION['user-account']; ?>" src="<?php echo GetPhoDir($_SESSION['user-account']); ?>" height="70" width="70">
  </div>

  <div class="setting-button-upload">
   <button type="submit" name="upload" value="upload" class="btn btn-default">上传新头像</button>
   <span class="help-block">大小最好为为250x250,支持的格式有.jpg|.gif|.png|.bmp</span>
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
      <input name="confirm-delete" value="9" type="checkbox">确认删除请勾选我
    </label>
  </div>
  </div>
  </form>
</div>

  </div>

  <div class="tab-pane" id="mail">

  <div class="panel panel-default">

  <form action="setting.php" method="post" name="changemail">
  <div class="panel-heading">
  <h3 class="panel-title">邮箱设置</h3>
  </div>
  <div class="panel-body">

  <div class="alert alert-info" role="alert">现在的邮箱:<?php echo $_SESSION['user-account']; ?></div>

  <div class="mail-col">
    <div class="input-group">
      <input type="text" name="neweamil" class="form-control" placeholder="请输入新邮箱">
      <span class="input-group-btn">
        <button class="btn btn-default" name="submit-newemail" value="submit-newemail" type="submit">变更邮箱</button>
      </span>
    </div><!-- /input-group -->
  </div>

  </div>
  </form>

  </div>

  </div>

  <div class="tab-pane" id="friends">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">资源信息</h3>
  </div>
  <div class="panel-body">

  <div class="list-group">
<?php

$myuid=GetUid($_SESSION['user-account']);
$allitem=GetItem("userpro/".$myuid);

foreach ($allitem as $key => $value){
  if($value!='..' and $value!='.'){
    $itemsize=getRealSize(getDirSize("userpro/$myuid/$value"));
?>

  <a href="item.php?name=<?php echo $value; ?>&uid=<?php echo $myuid; ?>" class="list-group-item" target="_blank">
    <h4 class="list-group-item-heading"><?php echo $value; ?></h4>
    <p class="list-group-item-text"><?php echo $itemsize; ?></p>
  </a>

<?php
  }
}

?>
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

<?php 
$msg=new MsgController();

$idqueue=$msg->GetTo(GetUid($_SESSION['user-account']));
$idcnt=count($idqueue);
if($idcnt!=0){
  foreach ($idqueue as $key => $id) {
    $lastmsg=$msg->GetLastMsg(GetUid($_SESSION['user-account']),$id);
?>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="friends-photo">
     <a href="user.php?uid=<?php echo $id; ?>" target="_blank"><img class="img-thumbnail" src="<?php echo GetPhoDir(GetEmail($id)); ?>" height="50" width="50"></a>
    </div>
    <div class="friends-detail">
    <p>与 <a href="message.php?to=<?php echo $id; ?>" target="_blank"><?php echo GetName($id); ?></a> 的最后一次对话 <span class="glyphicon glyphicon-time" id="sys-info-icon"></span> <?php echo $lastmsg[1]; ?></p>
    <p id="sys-info-icon"><span class="glyphicon glyphicon-edit"></span> <?php echo $lastmsg[0]; ?></p>
    </div>
  </div>
</div>
<?php
  }
}else{
  echo '暂无数据';
}
?>

  </div>
  </div> 

      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">系统通知</h3>
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