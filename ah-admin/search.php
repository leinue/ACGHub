<?php include('header.php'); 
  date_default_timezone_set('Etc/GMT-8');

  if($_POST['usersearch']=="usersearch"){
    $usersea=test_input($_POST['seauser']);
    if(strlen($usersea)!=0){
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


<?php
      $seallid=GetAllId();
      if(!(is_numeric($usersea))){
        if(isEmail($usersea)){
          $usersea=GetUid($usersea);
          if($usersea==false){
            echo '没找到';
          }
        }
      }
      foreach ($seallid as $key => $id) {
        if($usersea==$id){
          $numofsea=new DBConcerningForking(1);
          $numam=$numofsea->GetFollowedAmount($id);
          connect_mysql();
?>
    <div class="panel panel-default">
      <div class="panel-body">
      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <a href="../user.php?uid=<?php echo $id; ?>" target="_blank"> <?php echo GetName($id); ?></a>
        </div>

        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-eye-open"></span><span> <?php echo $numam; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-time"></span><span> <?php echo GetRegTime($id); ?></span>
        </div>
      </div>
      </div>
    </div>      
<?php
        }else{
          //没找到
        }
      }
?>

  </div>
</div>
</div>
<?php
    }else{

    }
  }

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


<?php
      $seares=new RecommendWorks(0,1);
      foreach ($seares->itemname as $key => $resname) {
        if($resname==$researched){
          //$resmulu="../userpro/".$seares->itemuid[$key]."/".$resname;
?>
    <div class="panel panel-default">
      <div class="panel-body">
      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <a href="../item.php?name=<?php echo $resname; ?>&uid=<?php echo $seares->itemuid[$key]; ?>" target="_blank"> <?php echo $resname; ?></a>
        </div>

        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-user"></span><span> <a href="../user.php?uid=<?php echo $seares->itemuid[$key]; ?>" target="_blank"><?php echo $seares->itemeditor[$key]; ?></a></span>
        <span id="res-infoa" class="glyphicon glyphicon-eye-open"></span><span> <?php echo GetFollowerNum($seares->itemuid[$key],$resname); ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-thumbs-up"></span><span> <?php echo GetLikerNum($resname); ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-time"></span><span> <?php echo date("Y-m-d H:i:s",$seares->itemtime[$key]); ?></span>
        </div>
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