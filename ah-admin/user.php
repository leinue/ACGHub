<?php include('header.php'); ?>


<div class="user-content" id="user-body">

   <div class="user-content-main">

   <div class="panel panel-default">
         <div class="panel-body">

         <form class="navbar-form" role="search" id="panel-search-right">
         <div class="input-group">
         <input type="text" class="form-control" placeholder="搜索用户">
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
              <option value="forbidden">禁言</option>
         </select>
         <button type="button" class="btn btn-default btn-sm" id="speace">应用</button>



         <select class="form-control input-sm">
              <option value="change">变更用户身份</option>
              <option value="admin">管理员</option>
              <option value="user">普通用户</option>
         </select>
         <button type="button" class="btn btn-default btn-sm">应用</button>

         </div>

         </div>

         </div>
    </div>

<div class="panel panel-default">
  <?php 

  $allid=GetAllId();
  $allusercnt=count($allid);
  $admincnt=GetNumOfAdmin();
  $usercnt=GetNumOfUser();

  $attr=test_input($_GET['attr']);
  $page=test_input($_GET['page']);

  if(strlen($page)==0){
    $page=1;
  }else{
    if(!is_numeric($page)){header("location:user.php?attr=all");}
  }

  if(strlen($attr)==0){$attr="all";}

  function PrintUserList($type){
    //1->all 2->admin 3->user
    switch ($type) {
      case 1:
        $allid=GetAllId();
        for($i=0;$i<count($allid);$i++){
          echo '<tr>';
          echo '<td><input type="checkbox" value=""></td>';
          echo '<td><a href="../user.php?uid='.$allid[$i].'" target="_blank">'.GetName($allid[$i]).'</s></td>';
          echo '<td><a href="mailto:'.GetEmail($allid[$i]).'" target="_blank">'.GetEmail($allid[$i]).'</a></td>';
          echo '<td>'.GetResCount($allid[$i],2).'</td>';
          echo '<td>'.GetStatus($allid[$i]).'</td>';
          echo '<td>'.GetRegTime($allid[$i]).'</td>';
          echo '</tr>';
        }
        break;
      case 2:

        break;
      case 3:

        break;
      default:
        return false;
        break;
    }
  }

  ?>
  <div class="panel-heading">
  <span id="user-op"><a href="user.php?attr=all">全部用户（<?php echo $allusercnt; ?>）</a></span> | 
  <span id="user-op"><a href="user.php?attr=admin">管理员（<?php echo $admincnt; ?>）</a></span> | 
  <span id="user-op"><a href="user.php?attr=user">普通用户（<?php echo $usercnt; ?>）</a></span>
  </div>

  <table class="table table-striped">

    <tr>
       <th><input type="checkbox" value=""></th>
       <th>用户名</th>
       <th>注册邮箱</th>
       <th>资源数量</th>
       <th>用户身份</th>
       <th>注册时间</th>
    </tr>

<?php

switch ($attr){
  case "all":
    PrintUserList(1);
    break;
  case "admin":
    //PrintUserList(2);
    break;
  case "user":
    //PrintUserList(3);
    break;
  default:
    header("location:user.php?attr=all");
    break;
}

?>

  </table>

</div>

<div class="paging">
<ul class="pagination">
  <li><a href="user.php?attr=<?php echo $attr; ?>&page=<?php ?>">&laquo;</a></li>
  <li><a href="user.php?attr=<?php echo $attr; ?>&page=<?php ?>">1</a></li>
  <li><a href="user.php?attr=<?php echo $attr; ?>&page=<?php ?>">&raquo;</a></li>
</ul>
</div>

   <div class="panel panel-default">
         <div class="panel-body">
         <div id="panel-col-left">

         <div class="navbar-form">

         <select class="form-control input-sm">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
              <option value="forbidden">禁言</option>
         </select>
         <button type="button" class="btn btn-default btn-sm" id="speace">应用</button>
         </div>

         </div>

         </div>
    </div>

   </div>

</div>

<?php include('footer.php'); ?>