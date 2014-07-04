<?php 
     if($_SESSION['user-login-id']!=1){
?>
<main>
	<div class="row">
		<div class="col-lg-8 col-lg-push-2">
		    
		<h1 class="blog-title">
			<a href="/">从这里更好的发布你的创意</a>
		</h1>
		<h2 class="blog-desc">
			<a href="/">ԅ(¯ㅂ¯ԅ) 剧本 分镜 设定 代码 配音<span class="glyphicon glyphicon-send"></span></a>
		</h2>
        
		</div>
    </div>
    
	<div class="row">
    
        <div class="col-md-8 col-md-offset-2" id="ad">
        
        <div class="col-md-6" id="one-half-right">
        
        <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-front">
        
        </div>
        <div class="col-md-6" id="one-half-botttom">
         
         <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-front">
  
        </div>
        
        <div class="col-md-6" id="one-half-right-none-bottom">
        
         <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-bottom">
         
        </div>
        
        <div class="col-md-6">
        
         <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-bottom">
         
        </div>
             
       </div>
    </div>

</main>
    <?php
    }
    else{
    ?>
<main>
<div class="user-per">

<div class="trends">

<ul class="list-group">
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>  
</ul>

</div>

<div class="res-right">

<div class="panel panel-default">
  <div class="panel-heading">你的目录</div>
  <div class="panel-body">
    <ul class="nav nav-tabs" role="tablist">
     <li class="active"><a href="#">全部</a></li>
     <li><a href="#">公共</a></li>
     <li><a href="#">私有</a></li>
     <li><a href="#">关注</a></li>
    </ul>
  </div>
</div>

</div>

</div>
</main>
    <?php
    }
    ?>
