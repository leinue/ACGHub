<?php 
include('header.php');

$content=test_input($_POST['stasea']);

?>


<div class="search-body">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">搜索结果</h3>
  </div>
  <div class="panel-body">
<?php 

$fs=new FuzzySearch();
$fs->GetDataByName("i");

?>
  <div class="panel panel-default">
  <div class="panel-body">
      <div class="r">
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
      </div>
  </div>
  </div>

  </div>
</div>

</div>
<?php include('footer.php'); ?>