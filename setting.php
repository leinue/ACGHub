<?php 
include('header.php'); 
?>

<?php 
connect_mysql();

     if($_SESSION['user-login-id']==1){

      if($_POST['upload']=="upload"){
        
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
  <h3 class="panel-title">关注</h3>
  </div>
  <div class="panel-body">

<?php

function echo_fork_list($name,$msg_url){
  echo '    <div class="f-i-left">
      <div class="panel panel-default">
     <div class="panel-body">

      <div class="friends-photo">
<img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
      </div>

      <div class="friends-detail">
      <p><a href="#">'.$name.'</a></p>
      <p><a href="'.$msg_url.'">私信</a></p>
      </div>

    </div>
     </div>
    </div>';
}

$sql="SELECT `friends` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";

$res=mysql_query($sql);
if($res!=false){
  $row=mysql_fetch_row($res);
  //$row[0]=%fans%={|%uid%=19|$&$|%uid%=15|}|&&|%fork%={|%uid%=15|$&$||};
  if($row[0]!=""){
  $ff=explode("|&&|", $row[0]);

  //**********************************关注******************************************

  $fans=substr($ff[0],strlen("%fans%={|"),strlen($ff[0])-strlen("%fans%={|")-1);
  $fans_ex=explode("|$&$|", $fans);

  foreach ($fans_ex as $key => $value) {
    $uid=substr($value, strlen("%uid%="),strlen($value)-strlen("%uid%="));
    $sql="SELECT `name` FROM `acghub_member` WHERE `id`=".$uid;
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      $send_msg_url="message.php?uid=".$uid;

      echo '     <div class="f-i-left">
      <div class="panel panel-default">
     <div class="panel-body">

      <div class="friends-photo">
<img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
      </div>

      <div class="friends-detail">
      <p><a href="#">'.$row[0].'</a></p>
      <p><a href="'.$send_msg_url.'">私信</a></p>
      </div>

    </div>
     </div>
    </div>';

    }
    else{
      echo '数据库错误';
    }

  }

  //**********************************粉丝******************************************

  $fork=substr($ff[1],strlen("%fork%={|"),strlen($ff[0])-strlen("%fork%={|")-1);
  $fork_ex=explode("|$&$|", $fork);


}
else{
  echo '无';
}
}
else{
  echo '数据库出错';
}


?>

  </div>
  </div>

  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">粉丝</h3>
  </div>
  <div class="panel-body">
  	
<?php

  foreach ($fork_ex as $key => $value){
    $uid=substr($value, strlen("%uid%="),strlen($value)-strlen("%uid%="));
    $sql="SELECT `name` FROM `acghub_member` WHERE `id`=".$uid;
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      $send_msg_url="message.php?uid=".$uid;
      echo_fork_list($row[0],$send_msg_url);
    }
    else{
      echo '数据库错误';
    }
}
?>

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

function echo_sys_info($content,$time){

echo '<div class="panel panel-default">
         <div class="panel-body"  id="sys-info-icon">
          <span class="glyphicon glyphicon-warning-sign"></span> [系统通知]

           <p><span class="sys-sty">'.$content.'</span></p>
           <p><span class="sys-sty">'.$time.'</span></p>
         </div>
        </div>';
}
      $sql="SELECT `message` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
      $res=mysql_query($sql);
      if($res!=false){
        $row=mysql_fetch_row($res);
        //$row[0]=%type%=1|&&|%obj%={|hahahaha|}|&&|%content%={|hhhhh+==+23333|}*\-/*%type%=1|&&|%obj%={|sangxinbingkuang|}|&&|%content%={|sdfs+==+123456789|}*\-/*%type%=0|&&|%content%={|dfgfdg+==+789456|}
        $str_msg=explode("*\-/*", $row[0]);
        foreach ($str_msg as $key0 => $value0) {
          //$value[0]=%type%=1|&&|%obj%={|蛤蛤蛤|}|&&|%content%={|hhhhh+==+23333|}|&&|%uid%={|15|}
          //$value[1]=%type%=1|&&|%obj%={|sangxinbingkuang|}|&&|%content%={|sdfs+==+123456789|}|&&|%uid%={|15|}
          $str_msg_solo=explode("|&&|", $value0);
          foreach ($str_msg_solo as $key1 => $value1) {
            //$value[0]=%type%=1;$value[1]=%obj%={|蛤蛤蛤|};$value[2]=%content%={|hhhhh+==+23333|}
            $msg_type=substr($str_msg_solo[0], strlen("%type%="));
            if($msg_type=="9"){
              $obj_name=substr($str_msg_solo[1], strlen("%obj%={|"),strlen($str_msg_solo[1])-strlen("|}"));
              $obj_name=str_replace('|}', '', $obj_name);

              $msg_content=substr($str_msg_solo[2], strlen("%content%={|"),strlen($str_msg_solo[1])-strlen("|}"));
              $msg_content=str_replace('|}', '', $msg_content);

              $msger_uid=substr($str_msg_solo[3], strlen("%uid%={|"),strlen($str_msg_solo[1])-strlen("|}"));
              $msger_uid=str_replace('|}', '', $msger_uid);

              $msger_url="message.php?uid=".$msger_uid."?content=".$msg_content;

              $msg_content_solo=explode("+==+", $msg_content);
              $num_arrary=count($msg_content_solo);
              $last_msg=$msg_content_solo[$num_arrary-1];
?>
      <div class="panel panel-default">
       <div class="panel-body">     
        <div class="friends-photo">
            <a href="#"><img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50"></a>
        </div>
        <div class="friends-detail">
            <p>与 <a href="<?php echo $msger_url; ?>" target="_blank"><?php echo $obj_name; ?></a> 的最后一次对话</p>
            <p id="#sys-info-icon"><span class="glyphicon glyphicon-chevron-left"></span><?php echo $last_msg; ?><span class="glyphicon glyphicon-chevron-right"></span></p>
        </div>
       </div>
       </div>
<?php
           break;
            }
            elseif($msg_type=="8"){
              //$value[2]=%type%=8|&&|%content%={|system info+==+2011-01-01|}
              $sys_content=substr($str_msg_solo[1], strlen("%content%={|"),strlen($str_msg_solo[1])-strlen("|}"));
              $sys_content=str_replace('|}', '', $sys_content);
              $sys_con_solo=explode("+==+", $sys_content);
              $count_sys_info=substr_count($row[0],'%type%=8');
              break;
              //系统消息
            }
          }
        }

?>

      </div>
      </div> 

      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">系统通知</h3>
        </div>

      <div class="panel-body">

<?php
for($sys_info_index=0;$sys_info_index<$count_sys_info;$sys_info_index++)
echo_sys_info($sys_con_solo[0],$sys_con_solo[1]);
?>
      </div>

    </div> 
      
<?php
     }
     else{
?>
   
   <p>数据库出错</p>
 
<?php
     }
?>
     

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