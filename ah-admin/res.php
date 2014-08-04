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
 function GetItemCount_solo($type){
  switch ($type) {
    case 0:
      $allres=new RecommendWorks(0,1);
      $res_count=count($allres->itemname);
      return $res_count;
      break;
    default:
      $allres=new RecommendWorks($type,1);
      $allres->InitializeRecommendedItem(1);
      $solo_count=count($allres->newitemname);
      return $solo_count;
      break;
  }
 }

 $attr=test_input($_GET['attr']);
 $cetpage=test_input($_GET['page']);

 if(strlen($cetpage)==0){$cetpage=1;}

 if(strlen($attr)==0){
  $attr="all";}

 ?>
  <div class="panel-heading">
  <span id="user-op"><a href="res.php?attr=all">全部（<?php echo GetItemCount_solo(0); ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=script">脚本（<?php echo GetItemCount_solo(1); ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=storyboard">分镜（<?php echo GetItemCount_solo(2); ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=enactment">设定（<?php echo GetItemCount_solo(3); ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=code">代码（<?php echo GetItemCount_solo(4); ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=music">音乐（<?php echo GetItemCount_solo(6); ?>）</a></span> | 
  <span id="user-op"><a href="res.php?attr=dubbing">配音（<?php echo GetItemCount_solo(5); ?>）</a></span>
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

 function PrintResourceList($protype,$cetpage){
  $PagingInfo=array();
  $res_print_cnt=0;

  switch ($protype){
    case 0:
      $allres=new RecommendWorks($protype,1);
      if(count($allres->itemname)!=0){
        $ptn=new Pagination($allres->itemname,$cetpage);
        $PagingInfo[0]=$ptn->PageSize;
        $ptn->InitializePageingInfo();
        for ($i=$ptn->StartKey;$i<$ptn->Endkey;$i++){
          echo '  <tr>';
          echo '  <td><input type="checkbox" value=""></td>';
          echo '  <td><a href="../item.php?name='.$allres->itemname[$i].'&uid='.$allres->itemuid[$i].'" target="_blank">'.$allres->itemname[$i].'</a></td>';
          echo '  <td><a href="../user.php?uid='.$allres->itemuid[$i].'" target="_blank">'.$allres->itemeditor[$i].'</a></td>';
          echo '  <td>'.GetStatus($allres->itemuid[$i]).'</td>';
          echo '  <td>'.date("Y-m-d H:i:s",$allres->itemtime[$i]).'</td>';
          echo '  </tr>';
        }
        /*foreach ($allres->itemname as $key => $value) {
          echo '  <tr>';
          echo '  <td><input type="checkbox" value=""></td>';
          echo '  <td><a href="../item.php?name='.$value.'&uid='.$allres->itemuid[$key].'" target="_blank">'.$value.'</a></td>';
          echo '  <td><a href="../user.php?uid='.$allres->itemuid[$key].'" target="_blank">'.$allres->itemeditor[$key].'</a></td>';
          echo '  <td>'.GetStatus($allres->itemuid[$key]).'</td>';
          echo '  <td>'.date("Y-m-d H:i:s",$allres->itemtime[$key]).'</td>';
          echo '  </tr>';
          $res_print_cnt++;

          if($res_print_cnt==$ptn->Endkey){break;}
        }*/
      }else{
        echo '';
    }
    default:
      $otheres=new RecommendWorks($protype,1);
      $otheres->InitializeRecommendedItem(1);
      if(count($otheres->newitemname)!=0){
        $ptn=new Pagination($otheres->newitemname,$cetpage);
        $PagingInfo[0]=$ptn->PageSize;
        $ptn->InitializePageingInfo();
        for ($i=$ptn->StartKey;$i<$ptn->Endkey;$i++){
          echo '  <tr>';
          echo '  <td><input type="checkbox" value=""></td>';
          echo '  <td><a href="../item.php?name='.$otheres->newitemname[$i].'&uid='.$otheres->newitemuid[$i].'" target="_blank">'.$otheres->newitemname[$i].'</a></td>';
          echo '  <td><a href="../user.php?uid='.$otheres->newitemuid[$i].'" target="_blank">'.$otheres->newitemeditor[$i].'</a></td>';
          echo '  <td>'.GetStatus($otheres->newitemuid[$i]).'</td>';
          echo '  <td>'.date("Y-m-d H:i:s",$otheres->newitemtime[$i]).'</td>';
          echo '  </tr>';
        }
        /*foreach ($otheres->newitemname as $key => $value) {
          echo '  <tr>';
          echo '  <td><input type="checkbox" value=""></td>';
          echo '  <td><a href="../item.php?name='.$value.'&uid='.$otheres->newitemuid[$key].'" target="_blank">'.$value.'</a></td>';
          echo '  <td><a href="../user.php?uid='.$otheres->newitemuid[$key].'" target="_blank">'.$otheres->newitemeditor[$key].'</a></td>';
          echo '  <td>'.GetStatus($otheres->newitemuid[$key]).'</td>';
          echo '  <td>'.date("Y-m-d H:i:s",$otheres->newitemtime[$key]).'</td>';
          echo '  </tr>';        
        }*/
      }else{
        echo '';
      }
  }

  return $PagingInfo;
 }

 date_default_timezone_set('UTC'); 
 switch ($attr){
   case "all":
     $pageinfo=PrintResourceList(0,$cetpage);
     break;
   case "script":
     $pageinfo=PrintResourceList(1,$cetpage);
     break;
   case "storyboard":
     $pageinfo=PrintResourceList(2,$cetpage);
     break;
   case "enactment":
     $pageinfo=PrintResourceList(3,$cetpage);
     break;
   case "code":
     $pageinfo=PrintResourceList(4,$cetpage);
     break;
   case "dubbing":
     $pageinfo=PrintResourceList(5,$cetpage);
     break;
   case "music":
     $pageinfo=PrintResourceList(6,$cetpage);
     break;
   default:
     header("location:res.php?atrr=all");
     break;
 }
 ?>
  </table>

</div>

<div class="paging">
<ul class="pagination">
<?php 
if($cetpage==$pageinfo[0]){
  $NextPage=$PageSize;
}else{
  $NextPage=$cetpage+1;}

if($cetpage==1){
  $prepage=1;
}else{$prepage=$cetpage-1;}

?>
  <li><a href="res.php?attr=<?php echo $attr; ?>&page=<?php echo $prepage; ?>">&laquo;</a></li>
<?php
for ($i=1;$i<=$pageinfo[0]; $i++){
     $resPageURL="res.php?attr=$attr&page=$i";
     echo '<li><a href="'.$resPageURL.'">'.$i.'</a></li>';
}
?>
  <li><a href="res.php?attr=<?php echo $attr; ?>&page=<?php echo $NextPage; ?>">&raquo;</a></li>
</ul>  
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