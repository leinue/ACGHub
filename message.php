<?php 
include('header.php'); 

connect_mysql();

if($_SESSION['user-login-id']==1){

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
$toid=test_input();
 ?>

    </h3>
  </div>
  <div class="panel-body">
  <form>
  <div class="msg-send">
    <div class="col-lg-20">
    <div class="input-group">
      <textarea class="form-control" rows="3"></textarea>
      <span class="input-group-btn" id="btn-send-msg">
        <button class="btn btn-default" type="submit">发送</button>
      </span>
    </div>
  </div>
</div>
</form>

  <div class="msg-viusal">

  <div class="msg-visual-left">
<div class="u">  
  <div class="row">
  <div class="col-xs-2 col-sm-2">
 <div class="face">
   <img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
  </div>
<span class="glyphicon glyphicon-chevron-left" id="chat-sign"></span>
  </div>

  <div class="col-xs-6">
  <div class="panel panel-default" id="msg-detail">
  <div class="panel-body">
  $msg_de_ex[$msg_ct_index]
  </div>
  </div>
  <span class="help-block">2014-7-10 13:56</span>
  </div>
  </div>
  </div>


  </div>

  <div class="msg-visual-right">

  <div class="u">  
  <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-10">
  <div class="panel panel-default" id="msg-detail">
  <div class="panel-body">
    Basic panel example<br>Basic panel example<br>Basic panel example
  </div>
  </div>
  <span class="help-block">2014-7-10 13:56</span>
  </div>
  <div class="col-xs-2 col-md-2">
  <div class="face">
   <img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
  </div>
<span class="glyphicon glyphicon-chevron-right" id="chat-sign-right"></span>
  </div>
  </div>
  </div>

  <div class="u">  
  <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-10">
  <div class="panel panel-default" id="msg-detail">
  <div class="panel-body">
    Basic panel example<br>Basic panel example<br>Basic panel example
  </div>
  </div>
  <span class="help-block">2014-7-10 13:56</span>
  </div>
  <div class="col-xs-2 col-md-2">
  <div class="face">
   <img class="img-thumbnail" src="http://i0.hdslb.com/user/1248/124871/myface_m.jpg" height="50" width="50">
  </div>
<span class="glyphicon glyphicon-chevron-right" id="chat-sign-right"></span>
  </div>
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