<?php 
include('header.php'); 

connect_mysql();

if($_SESSION['user-login-id']==1){
  
  $toid=test_input($_GET['to']);
  $myuid=GetUid($_SESSION['user-account']);

  if($_POST['send']=="send"){
    $content=test_input($_POST['content']);
    if(strlen($content)!=0){
      $send_msg=new MsgController();
      if($send_msg->SendTo($myuid,$toid,$content)){
      }else{echo '发送失败';}
    }
  }

?>

<div class="user-per" >

<div id="message-menu">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">菜单</h3>
  </div>
  <div class="panel-body">

  <ul class="nav nav-pills nav-stacked">
  <li class="active"><a href="#send" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> 查看私信</a></li>
  </ul>

  </div>
</div>
</div>


<div class="res-info">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
 <?php
 if(is_numeric($toid)){
  if(GetName($toid)!=false){
    echo '与 <a href="user.php?uid='.$toid.'" target="_blank">'.GetName($toid).'</a> 的聊天记录';
  }else{
    header("Location:index.php");
  }
 }else{header("Location:index.php");}

 ?>
    </h3>
  </div>
  <div class="panel-body">
  <form action="message.php?to=<?php echo $toid; ?>" method="post">
  <div class="msg-send">
    <div class="col-lg-20">
    <div class="input-group">
      <textarea name="content" class="form-control" rows="3"></textarea>
      <span class="input-group-btn" id="btn-send-msg">
        <button name="send" value="send" class="btn btn-default" type="submit">发送</button>
      </span>
    </div>
  </div>
</div>
</form>

  <div class="msg-viusal">
<?php
$msg=new MsgController();

$MsgContentQueueOfSender=$msg->GetContent(0,$myuid,$toid);
$MsgContentQueueOfReceiver=$msg->GetContent(1,$myuid,$toid);

$MsgTimeQueueOfSender=$msg->GetDateTime(0,$myuid,$toid);
$MsgTimeQueueOfReceiver=$msg->GetDateTime(1,$myuid,$toid);

$SenderCnt=count($MsgContentQueueOfSender);
$ReceiverCnt=count($MsgContentQueueOfReceiver);

?>
  <div class="msg-visual-left">
<?php
if($SenderCnt!=0){
  foreach ($MsgContentQueueOfSender as $key => $value){
?>
  <div class="u">  
  <div class="row">
  <div class="col-xs-2 col-sm-2">
  <div class="face">
   <img class="img-thumbnail" src="<?php echo GetPhoDir(GetEmail($myuid)); ?>" height="50" width="50">
  </div>
   <span class="glyphicon glyphicon-chevron-left" id="chat-sign"></span>
  </div>

  <div class="col-xs-12 col-sm-6 col-md-8">
  <div class="panel panel-default" id="msg-detail">
  <div class="panel-body">
  <?php echo $value; ?>
  </div>
  </div>
  <span class="help-block"><?php echo $MsgTimeQueueOfSender[$key]; ?></span>
  </div>
  </div>
  </div>
<?php
  }
}
?>
  </div>

  <div class="msg-visual-right">
<?php
if($ReceiverCnt!=0){
  foreach ($MsgContentQueueOfReceiver as $key => $value) {
?>
  <div class="u">  
  <div class="row">
  <div class="col-xs-2 col-sm-2">
  <div class="face">
   <img class="img-thumbnail" src="<?php echo GetPhoDir(GetEmail($myuid)); ?>" height="50" width="50">
  </div>
   <span class="glyphicon glyphicon-chevron-left" id="chat-sign"></span>
  </div>

  <div class="col-xs-12 col-sm-6 col-md-8">
  <div class="panel panel-default" id="msg-detail">
  <div class="panel-body">
  <?php echo $value; ?>
  </div>
  </div>
  <span class="help-block"><?php echo $MsgTimeQueueOfReceiver[$key]; ?></span>
  </div>
  </div>
  </div>
<?php
  }
}
?>
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