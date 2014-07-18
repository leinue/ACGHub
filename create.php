<?php 
include('header.php');
connect_mysql();
 ?>

<?php 

     $sql="SELECT `checked` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
     if($_SESSION['user-login-id']==1){
      $result=mysql_query($sql);
      if($result!=false)
        $row=mysql_fetch_row($result);
        if($row[0]==1){

          if($_POST['create']=="create"){
            $pro_name=test_input($_POST['dir']);
            $pro_cls=test_input($_POST['pro_cls']);
            $pro_des=test_input($_POST['des']);
            $pro_type=test_input($_POST['optionsRadios']);

            if($pro_name==""){
              echo '项目名称不能为空';
            }
            else{
              if (!is_dir('userpro/')){
                mkdir('userpro/');
              }
              $sql="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
              $res=mysql_query($sql);
              if($res!=false){
                $row=mysql_fetch_row($res);
                if(!is_dir('userpro/'.$row[0])){
                  mkdir('userpro/'.$row[0]);
                }

                if (!is_dir('userpro/'.$row[0].'/'.$pro_name)){
                  mkdir('userpro/'.$row[0].'/'.$pro_name); 

                  if($pro_des!=""){
                    file_put_contents('userpro/'.$row[0].'/'.$pro_name.'/readme', $pro_des);
                  }

                  $pro_setting = fopen('userpro/'.$row[0].'/'.$pro_name.'/prosetting.afg', "w") or die("Unable to open file!");
                  $txt_setting="type=".$pro_type."\r\n";
                  fwrite($pro_setting, $txt_setting);
                  $txt_setting="class=".$pro_cls."\r\n";
                  fwrite($pro_setting, $txt_setting);
                  fclose($pro_setting);

                  $wd=WriteDyn($_server['server_time']." Create $pro_name project");

                  header("location:user.php");

                }
                else{echo '重复';}

              }
              else{echo '数据库出错';}

            }

          }


?>

<div class="create-body">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">新建一个项目</h3>
  </div>
  <div class="panel-body">


<form class="form-create" action="create.php" method="post">
<input type="text" name="dir" class="form-control" placeholder="目录名">
<span class="help-block">不妨起一个简短可记的名字,必选</span>

<select class="form-control input-sm" name="pro_cls">
  <option value="script">脚本</option>
  <option value="Storyboard">分镜</option>
  <option value="enactment">设定</option>
  <option value="code">代码</option>
  <option value="dubbing">配音</option>
  <option value="music">音乐</option>
</select>
<span class="help-block">选择你的项目类别,必选</span>


<textarea class="form-control" rows="3" name="des" placeholder="描述"></textarea>
<span class="help-block">给你的项目一个简单的描述,将放入目录中作为ReadMe文件,可选</span>

<div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="public" checked>
    <span class="glyphicon glyphicon-retweet"> 公开</span>
  </label>
</div>
<span class="help-block">每个人都可以看到这条目录,并且可以关注/修改</span>

<div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios2" value="private">
    <span class="glyphicon glyphicon-lock"> 私有</span>
  </label>
</div>
<span class="help-block">由你选择谁可以关注/修改这条目录</span>

<button type="submit" name="create" value="create" class="btn btn-success">确认创建</button>
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
      <div class="create-body">

      <div class="panel panel-default">
      <div class="panel-heading">
      <h3 class="panel-title">请进入邮箱进行验证</h3>
      </div>
      <div class="panel-body">
       <div class="alert alert-info" role="alert">

       为了保证您帐号的合法性同时减轻服务器对垃圾信息的过滤，请进入邮箱进行帐号验证。验证之后您可以享受创建项目服务。

       </div>
      </div>
      </div>

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