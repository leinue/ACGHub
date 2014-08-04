<?php include('header.php'); ?>

<div class="user-content" id="user-body">

   <div class="user-content-main">

   <div class="panel panel-default">
         <div class="panel-body">

         <form class="navbar-form" role="search" id="panel-search-right">
         <div class="input-group">
         <input type="text" class="form-control" placeholder="搜索资源">
         <span class="input-group-btn">
         <button class="btn btn-default" type="button">搜索</button>
         </span>
         </div><!-- /input-group -->
         </form>

         <div id="panel-col-left">

         <div class="navbar-form">

         <select class="form-control input-sm">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
         </select>
         <button type="button" class="btn btn-default btn-sm" id="speace">应用</button>

         </div>

         </div>

         </div>
    </div>

   	<div class="panel panel-default">
 <?php 
 $allres=new RecommendWorks(0,1);
 $res_count=count($allres->itemname);
 $attr=test_input($_GET['attr']);

 if(strlen($attr)==0){
  $attr="all";}

 ?>
  <div class="panel-heading">
  <span id="user-op"><a href="res.php?attr=all">全部（<?php echo $res_count; ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=script">脚本</a></span> | 
  <span id="user-op"><a href="res.php?attr=storyboard">分镜</a></span> | 
  <span id="user-op"><a href="res.php?attr=enactment">设定</a></span> | 
  <span id="user-op"><a href="res.php?attr=code">代码</a></span> | 
  <span id="user-op"><a href="res.php?attr=music">音乐</a></span> | 
  <span id="user-op"><a href="res.php?attr=dubbing">配音</a></span>
  </div>

  <table class="table table-striped">

    <tr>
       <th><input type="checkbox" value=""></th>
       <th>资源名称</th>
       <th>作者</th>
       <th>作者身份</th>
       <th>上传时间</th>
    </tr>
 <?php

 function PrintResourceList($protype){
  switch ($protype){
    case 0:
      $allres=new RecommendWorks($protype,1);
      foreach ($allres->itemname as $key => $value) {
        echo '  <tr>';
        echo '  <td><input type="checkbox" value=""></td>';
        echo '  <td>'.$value.'</td>';
        echo '  <td>'.$allres->itemeditor[$key].'</td>';
        echo '  <td>'.GetStatus($allres->itemuid[$key]).'</td>';
        echo '  <td>'.date("Y-m-d H:i:s",$allres->itemtime[$key]).'</td>';
        echo '  </tr>';
      }
      break;
    default:
      $otheres=new RecommendWorks($protype,1);
      $otheres->InitializeRecommendedItem(1);
      foreach ($otheres->newitemname as $key => $value) {
        echo '  <tr>';
        echo '  <td><input type="checkbox" value=""></td>';
        echo '  <td>'.$value.'</td>';
        echo '  <td>'.$otheres->newitemeditor[$key].'</td>';
        echo '  <td>'.GetStatus($otheres->newitemuid[$key]).'</td>';
        echo '  <td>'.date("Y-m-d H:i:s",$otheres->newitemtime[$key]).'</td>';
        echo '  </tr>';        
      }
      break;
  }

 }
 date_default_timezone_set('UTC'); 
 switch ($attr){
   case "all":
     PrintResourceList(0);
     break;
   case "script":
     PrintResourceList(1);
     break;
   case "storyboard":
     PrintResourceList(2);
     break;
   case "enactment":
     PrintResourceList(3);
     break;
   case "code":
     PrintResourceList(4);
     break;
   case "dubbing":
     PrintResourceList(5);
     break;
   case "music":
     PrintResourceList(6);
     break;
   default:
     header("location:res.php?atrr=all");
     break;
 }
 ?>

  </table>

</div>

   <div class="panel panel-default">
         <div class="panel-body">
         <div id="panel-col-left">

         <div class="navbar-form">

         <select class="form-control input-sm">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
         </select>
         <button type="button" class="btn btn-default btn-sm" id="speace">应用</button>
         </div>

         </div>

         </div>
    </div>

   </div>

</div>

<?php include('footer.php'); ?>