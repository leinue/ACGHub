<?php
include('header.php');

$itemname=test_input($_GET['name']);
$uid=test_input($_GET['uid']);
$method=test_input($_GET['method']);

date_default_timezone_set('Etc/GMT-8');//设置时区

if($_SESSION['user-login-id']==1 and strlen($itemname)!=0 and strlen($uid)!=0){

  if(strlen($method)==0){

	if($_POST['del-all-item']=="del-all-item"){

		if(delsvndir("userpro/".$uid."/$itemname")){

      if(isFork($uid,$itemname,Getuid($_SESSION['user-account']))){
        DelFork($uid,$itemname,Getuid($_SESSION['user-account']));}

      if(isLike(Getuid($_SESSION['user-account']),$itemname)){
        DelLike($itemname,Getuid($_SESSION['user-account']),$uid);}

      if (isDislike(Getuid($_SESSION['user-account']),$itemname)) {
      }

			WriteDyn(date("Y-m-d H:i:s")." del $itemname project",$_SESSION['user-account']);
			header("location:user.php");
		}
		else{
			echo '删除失败';
		}
	}

  if($_POST['fork']=="fork"){
    if(WriteForkWorks($uid,$itemname,Getuid($_SESSION['user-account']))!=false){
      echo '关注成功';
    }
    else{echo '关注失败';}
  }

  if($_POST['unfork']=="unfork"){
    if(DelFork($uid,$itemname,Getuid($_SESSION['user-account']))!=false){
      echo '取关成功';
    }
    else{echo '取关失败';}
  }

  if($_POST['like']=="like"){
    if(islike(Getuid($_SESSION['user-account']),$itemname)!=true){
      WriteLike($itemname,$_SESSION['user-account']);
      WriteLiker(Getuid($_SESSION['user-account']),$itemname,GetEmail($uid));
    }
  }

  if($_POST['unlike']=="unlike"){
    DelLike($itemname,Getuid($_SESSION['user-account']),$uid);}

  if($_POST['dislike']=="dislike"){
    if(isDislike(Getuid($_SESSION['user-account']),$itemname)!=true){
      WriteDislike($itemname,$_SESSION['user-account']);
      WriteDisliker(Getuid($_SESSION['user-account']),$itemname,GetEmail($uid));
    }
  }

  if($_POST['undislike']=="undislike"){
    DelDislike($itemname,Getuid($_SESSION['user-account']),$uid);}

?>

<div class="overitem">

<div class="item-left">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">管理</h3>
  </div>
  <div class="panel-body">

<?php
 $url='item.php?name='.$itemname.'&uid='.$uid;
?>
<form name="operation" action="<?php echo $url; ?>" method="post">

   <div class="navbar-form">
         <select class="form-control input-sm">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
         </select>
         <button type="submit" class="btn btn-default btn-sm" id="speace">应用</button>
         <button type="button" class="btn btn-danger btn-sm" id="deleteallitem"  data-toggle="modal" data-target="#myModal">删除项目</button>
         <button type="button" class="btn btn-default btn-sm" id="quickly-jump"><span class="glyphicon glyphicon-list-alt"></span> 快速预览</button>
    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">确认删除</h4>
      </div>
      <div class="modal-body">
        您所进行的操作无法撤销,确认删除吗?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary" name="del-all-item" value="del-all-item">确认删除</button>
      </div>
    </div>
  </div>
</div>

</form>

  </div>
</div>
</div>

<div class="item-left">

<div class="panel panel-default">
  <div class="panel-heading">
  <?php
  $userName=GetName($uid);
  ?>
    <h3 class="panel-title"><?php echo '<a href="user.php?uid='.$uid.'" target="_blank" id="Username-pro">'.$userName.'</a>/'.$itemname; ?></h3>
  </div>
   <table class="table" id="table-size">

    <tr>
    <th><input type="checkbox" value=""></th>
    <th>文件</th>
    <th>详细</th>
    <th>时间</th>
    </tr>
    
<?php
   $conlist=GetItem("userpro/".$uid."/".$itemname);
   $a=count($conlist);
   if($conlist!=false){
   for($i = 2;$i<=$a-1;$i++){
    if($conlist[$i]!="prosetting.afg" and $conlist[$i]!="readme"){
        echo '<tr>
    <td><input type="checkbox" value=""></td>     
    <td>'.iconv('gbk','utf-8',$conlist[$i]).'</td>
    <td>'.$des.'</td>
    <td>1分钟以前</td>
    </tr>';
    }
    else{
      continue;
    }
   }
   }
   else{
    echo '<tr>
    <td>暂无数据</td>
    </tr>';
   }
?>
    
  </table>

  <div class="panel-footer">
<?php

if(strlen($itemname)!=0 and strlen($uid)!=0){

	$des=GetDes("userpro/".$uid."/".$itemname."/readme");

	if($des!=false){
		echo $des;
	}
	else{echo $itemname.'project';}
}
else{
	header("location:index.php");
}

?>
   
  </div>

</div>

</div>


<div class="item-right">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">菜单</h3>
  </div>
  <div class="panel-body">
<?php
$login_uid=Getuid($_SESSION['user-account']);

if($login_uid==$uid){
?>

<div class="item-split-menu">
<div class="btn-group btn-group-justified" id="item-split-menu-space">
    <div class="input-group">
      <input type="text" class="form-control" value="<?php echo 'item.php?name='.$itemname.'&uid='.$uid; ?>"disabled>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">分享</button>
      </span>
    </div><!-- /input-group -->
</div>
<span class="help-block">在这里可以分享项目的URL</span>
</div>

<div class="item-split-menu">
<div class="btn-group btn-group-justified" id="item-split-menu-space">
  <div class="btn-group">
    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-cloud-download"></span> 下载</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 赞者</button>
  </div>
</div>
</div>

<?php
}
else
{

?>
<div class="item-split-menu">

<form action="item.php?name=<?php echo $itemname."&uid=".$uid; ?>" method="POST" name="forkForm">
<div class="btn-group btn-group-justified" id="item-split-menu-space">
  <div class="btn-group">
  <?php
  if(!(isFork($uid,$itemname,Getuid($_SESSION['user-account'])))){
  ?>
  <button type="submit" name="fork" value="fork" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> 关注</button>
  <?php
  }
  else{
  ?>
   <button type="submit" name="unfork" value="unfork" class="btn btn-default"><span class="glyphicon glyphicon-eye-close"></span> 取关</button>
  <?php
  }
  ?>
  </div>
  <div class="btn-group">
  <?php
  if(islike(Getuid($_SESSION['user-account']),$itemname)){
  ?>
  <button type="submit" name="unlike" value="unlike" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up"></span> 取赞</button>
  <?php
  }
  else{
    if(isDislike(Getuid($_SESSION['user-account']),$itemname)){
  ?>
   <fieldset disabled><button type="submit" name="like" value="like" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up"></span> 碉堡</button></fieldset>
  <?php
    }
    else{
  ?>
   <button type="submit" name="like" value="like" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up"></span> 碉堡</button>
  <?php
    }
  ?>
  <?php
  }
  ?>
    
  </div>
  <div class="btn-group">
  <?php
  if(islike(Getuid($_SESSION['user-account']),$itemname)){
  ?>
  <fieldset disabled><button type="submit" name="dislike" value="dislike" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down"></span> 弱爆</button></fieldset>
  <?php
  }
  else{
    if(isDislike(Getuid($_SESSION['user-account']),$itemname)){
  ?>
    <button type="submit" name="undislike" value="undislike" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down"></span> 取弱</button>
  <?php
    }
    else{
  ?>
    <button type="submit" name="dislike" value="dislike" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down"></span> 弱爆</button>
  <?php
    }
  ?>
  <?php
  }
  ?>
  </div>  
</div>
</form>

</div>

<div class="item-split-menu">
<div class="btn-group btn-group-justified" id="item-split-menu-space">
    <div class="input-group">
      <input type="text" class="form-control" value="<?php echo 'item.php?name='.$itemname.'&uid='.$uid; ?>"disabled>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">分享</button>
      </span>
    </div><!-- /input-group -->
</div>
<span class="help-block">在这里可以分享项目的URL</span>
</div>

<div class="item-split-menu">
<div class="btn-group btn-group-justified" id="item-split-menu-space">
  <div class="btn-group">
    <a href="<?php echo "item.php?name=".$itemname."&uid=".$uid."&method=1"; ?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> 关注者(<?php echo GetFollowerNum($uid,$itemname); ?>)</button></a>
  </div>
  <div class="btn-group">
    <a href="<?php echo "item.php?name=".$itemname."&uid=".$uid."&method=2"; ?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 赞者(<?php echo GetLikerNum($itemname); ?>)</button></a>
  </div>
</div>
</div>

<?php

}

?>

  </div>
</div>

</div>

</div>

<?php
  }
  else{
?>
<div class="overitem">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">关注 <a href="<?php echo "item.php?name=".$itemname."&uid=".$uid; ?>"><strong><?php echo $itemname ?></a></strong> 项目的人</h3>
  </div>
  <div class="panel-body">

<?php
    $fouid=GetFollower($uid,$itemname);
    foreach ($fouid as $key => $value) {
      
      echo '<div class="foer">
    <div class="panel panel-default">
      <div class="panel-body">

      <div class="proeditor-photo">
        <img alt="'.GetName($value).'" class="img-rounded" src="'.GetPhoDir(GetEmail($value)).'" height="96" width="96">
      </div>
      
      <div class="proeditor">
         <p><a href=user.php?uid='.$value.'>'.GetName($value).'</a></p>
         <p><span class="glyphicon glyphicon-map-marker"></span> '.GetLocation($value).'</p>
      </div>

      </div>
    </div>
  </div>';
    }
?>

  </div>
</div>

</div>
<?php
  }

}
else{
	header('location:index.php');
}

include('footer.php');
?>