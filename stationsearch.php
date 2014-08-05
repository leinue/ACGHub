<?php 
include('header.php');

$content=test_input($_POST['stasea']);


    function PrintFuzzyResult($name){
      $fs=new FuzzySearch();
      $resu=$fs->GetDataByName($name);
      //if($resu!=false){
        foreach ($fs->FuzzyID as $key => $id){
          $resu=$fs->GetDataByUid($id);
          if($resu!=false){
?>
  <div class="panel panel-default">
  <div class="panel-body">
      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <img src="<?php echo $fs->UserPhotoDir; ?>" alt="<?php echo $fs->Name; ?>" class="img-thumbnail" width="28" height="28">
         <a href="user.php?uid=<?php echo $fs->uid; ?>" target="_blank"><?php echo $fs->Name; ?></a>
        </div>
        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-eye-open" title="粉丝数"></span><span> <?php echo $fs->NumOfFans; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-th" title="项目个数"></span><span> <?php echo $fs->NumOfPro; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-time" title="注册时间"></span><span> <?php echo $fs->RegTime; ?></span>
        </div>
      </div>
  </div>
  </div>
<?php
          }
        }
      //}else{
        //echo '数据库错误';}
    }


?>


<div class="search-body">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">搜索结果</h3>
  </div>
  <div class="panel-body">

<?php 

$fs=new FuzzySearch();

if(is_numeric($content)){
  $resu=$fs->GetDataByUid($content);
  if($resu!=false){
?>
  <div class="panel panel-default">
  <div class="panel-body">
      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <img src="<?php echo $fs->UserPhotoDir; ?>" alt="<?php echo $fs->Name; ?>" class="img-thumbnail" width="28" height="28">
         <a href="user.php?uid=<?php echo $fs->uid; ?>" target="_blank"><?php echo $fs->Name; ?></a>
        </div>
        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-eye-open" title="粉丝数"></span><span> <?php echo $fs->NumOfFans; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-th" title="项目个数"></span><span> <?php echo $fs->NumOfPro; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-time" title="注册时间"></span><span> <?php echo $fs->RegTime; ?></span>
        </div>
      </div>
  </div>
  </div>
<?php
  }else{
    PrintFuzzyResult($content);
  }
}

if(isEmail($content)){
  $resu=$fs->GetDataByEmail($content);
  if($resu!=false){
?>
  <div class="panel panel-default">
  <div class="panel-body">
      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <img src="<?php echo $fs->UserPhotoDir; ?>" alt="<?php echo $fs->Name; ?>" class="img-thumbnail" width="28" height="28">
         <a href="user.php?uid=<?php echo $fs->uid; ?>" target="_blank"><?php echo $fs->Name; ?></a>
        </div>
        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-eye-open" title="粉丝数"></span><span> <?php echo $fs->NumOfFans; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-th" title="项目个数"></span><span> <?php echo $fs->NumOfPro; ?></span>
        <span id="res-infoa" class="glyphicon glyphicon-time" title="注册时间"></span><span> <?php echo $fs->RegTime; ?></span>
        </div>
      </div>
  </div>
  </div>
<?php
  }  
}

if(!(is_numeric($content)) and !(isEmail($content))){
  PrintFuzzyResult($content);
}

?>


  </div>
</div>

</div>
<?php include('footer.php'); 

/*      <div class="r">
        <div class="res-user-title">
         <span class="label label-info" id="lable-res-cls">Info</span>
         <a href="">hhhh</a>
        </div>

        <div class="res-info">
        <span id="res-infoa" class="glyphicon glyphicon-user"></span><span> <a href="" target="_blank">yuio</a></span>
        <span id="res-infoa" class="glyphicon glyphicon-eye-open"></span><span> zxcv</span>
        <span id="res-infoa" class="glyphicon glyphicon-thumbs-up"></span><span> qwer</span>
        <span id="res-infoa" class="glyphicon glyphicon-time"></span><span> dfgh</span>
        </div>
      </div>*/

?>
