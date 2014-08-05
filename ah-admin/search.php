<?php include('header.php'); 

  if($_POST['searchres']=="searchres"){
    $researched=test_input($_POST['resname']);
    if(strlen($researched)!=0){
      
?>
<div class="user-content" id="user-body">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
    搜索结果
    <div class="searchform">
    <form target="_blank" class="navbar-form" role="search" id="panel-search-right" method="post" action="search.php">
      <div class="input-group">
      <input type="text" name="resname" class="form-control" placeholder="搜索资源">
      <span class="input-group-btn">
      <button class="btn btn-default" name="searchres" value="searchres" type="submit">搜索</button>
      </span>
      </div>
    </form>   
    </div>

    </h3>
  </div>
  <div class="panel-body">

    <div class="panel panel-default">
      <div class="panel-body">

      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <a href=""> hhhhh</a>
        </div>

        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-user"></span><span> <a href="">hhh</a></span>
        <span id="res-infoa" class="glyphicon glyphicon-eye-open"></span><span> 20</span>
        <span id="res-infoa" class="glyphicon glyphicon-thumbs-up"></span><span> 20</span>
        <span id="res-infoa" class="glyphicon glyphicon-time"></span><span> 2014-08-05</span>
        </div>
      </div>

      </div>
    </div>

  </div>
</div>
</div>
<?php
    }else{
?>
<div class="user-content" id="user-body">
<div class="alert alert-warning" role="alert">
  <a href="#" class="alert-link">
    <strong>Warning!</strong>搜索内容不能为空 <a href="res.php">点击返回</a>
  </a>
  <div class="searchform">
    <form target="_blank" class="navbar-form" role="search" id="panel-search-right" method="post" action="search.php">
      <div class="input-group">
      <input type="text" name="resname" class="form-control" placeholder="搜索资源">
      <span class="input-group-btn">
      <button class="btn btn-default" name="searchres" value="searchres" type="submit">搜索</button>
      </span>
      </div>
    </form>  
  </div>
</div>
</div>
<?php
    }
  }

?>

<?php include('footer.php'); ?>