<?php include('header.php'); 

  $attr=test_input($_GET['attr']);
  $page=test_input($_GET['page']);

  connect_mysql();

  if($_POST['delORforb']=="delORforb"){
    /*switch ($_POST['adminevent']) {
      case "delete":
        $um=new UserManagement();
        $um->del();
        break;
      case "forbidden":
        $um=new UserManagement();
        $um->Gag();
        break;
    }*/
  }

  if($_POST['stalter']=="stalter"){

  }

?>


<div class="user-content" id="user-body">

   <div class="user-content-main">

   <div class="panel panel-default">
         <div class="panel-body">

         <form class="navbar-form" action="search.php" method="POST" role="search" id="panel-search-right" target="_blank">
         <div class="input-group">
         <input type="text" name="seauser" class="form-control" placeholder="搜索用户,支持/邮箱/ID">
         <span class="input-group-btn">
         <button class="btn btn-default" name="usersearch" value="usersearch" type="submit">搜索</button>
         </span>
         </div><!-- /input-group -->
         </form>

         <div id="panel-col-left">

         <div class="navbar-form">
         <form method="POST" action="user.php?attr=<?php if(strlen($attr)==0){$attr="all";}echo $attr; ?>&page=<?php if(strlen($page)==0){$page=1;}echo $page; ?>">
         <select  class="form-control input-sm" name="adminevent">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
              <option value="forbidden">禁言</option>
         </select>
         <button type="submit" name="delORforb" value="delORforb" class="btn btn-default btn-sm" id="speace">应用</button>
         </form>
         </div>

         <div class="navbar-form">
         <form method="POST" action="user.php?attr=<?php echo $attr; ?>&page=<?php if(strlen($page)==0){$page=1;}echo $page; ?>">
         <select class="form-control input-sm" name="altersta">
              <option value="change">变更身份</option>
              <option value="admin">管理员</option>
              <option value="user">普通用户</option>
         </select>
         <button type="submit" name="stalter" value="stalter" class="btn btn-default btn-sm">应用</button>
         </form>
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

  if(strlen($page)==0){
    $page=1;
  }else{
    if(!is_numeric($page)){header("location:user.php?attr=all");}
  }

  if(strlen($attr)==0){$attr="all";}

  function PrintUserList($type,$page){
    //1->all 2->admin 3->user
    switch ($type) {
      case 1:
        $allid=GetAllId();
        $user_paging=new Pagination($allid,$page);
        $user_paging->InitializePageingInfo();
        //echo $paging->StartKey."->".$paging->EndKey;
        for($i=$user_paging->StartKey;$i<$user_paging->EndKey;$i++){
          echo '<tr>';
          echo '<td><input type="checkbox" value=""></td>';
          echo '<td><a href="../user.php?uid='.$allid[$i].'" target="_blank">'.GetName($allid[$i]).'</s></td>';
          echo '<td><a href="mailto:'.GetEmail($allid[$i]).'" target="_blank">'.GetEmail($allid[$i]).'</a></td>';
          echo '<td>'.GetResCount($allid[$i],2).'</td>';
          echo '<td>'.GetStatus($allid[$i]).'</td>';
          echo '<td>'.GetRegTime($allid[$i]).'</td>';
          echo '</tr>';
        }
        return $user_paging->PageSize;
        break;
      case 2:
        $adminuid=GetAdminUid();
        $user_paging=new Pagination($adminuid,$page);
        $user_paging->InitializePageingInfo(); 
        for($i=$user_paging->StartKey;$i<$user_paging->EndKey;$i++){
          echo '<tr>';
          echo '<td><input type="checkbox" value=""></td>';
          echo '<td><a href="../user.php?uid='.$adminuid[$i].'" target="_blank">'.GetName($adminuid[$i]).'</s></td>';
          echo '<td><a href="mailto:'.GetEmail($adminuid[$i]).'" target="_blank">'.GetEmail($adminuid[$i]).'</a></td>';
          echo '<td>'.GetResCount($adminuid[$i],2).'</td>';
          echo '<td>'.GetStatus($adminuid[$i]).'</td>';
          echo '<td>'.GetRegTime($adminuid[$i]).'</td>';
          echo '</tr>';
        }
        return $user_paging->PageSize;
        break;
      case 3:
        $useruid=GetUserUid();
        $user_paging=new Pagination($useruid,$page);
        $user_paging->InitializePageingInfo();           
        for($i=$user_paging->StartKey;$i<$user_paging->EndKey;$i++){
          echo '<tr>';
          echo '<td><input type="checkbox" value=""></td>';
          echo '<td><a href="../user.php?uid='.$useruid[$i].'" target="_blank">'.GetName($useruid[$i]).'</s></td>';
          echo '<td><a href="mailto:'.GetEmail($useruid[$i]).'" target="_blank">'.GetEmail($useruid[$i]).'</a></td>';
          echo '<td>'.GetResCount($useruid[$i],2).'</td>';
          echo '<td>'.GetStatus($useruid[$i]).'</td>';
          echo '<td>'.GetRegTime($useruid[$i]).'</td>';
          echo '</tr>';
        }
        return $user_paging->PageSize;
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
<script language=javascript>
function selectAll(){
var a = document.getElementsByTagName("input");
if(a[0].checked){
for(var i = 0;i<a.length;i++){
if(a[i].type == "checkbox") a[i].checked = false;
}
}
else{
for(var i = 0;i<a.length;i++){
if(a[i].type == "checkbox") a[i].checked = true;
}
}
}
</script>
    <tr>
       <th><input type="checkbox" name="selectall" onclick="selectAll()" value=""></th>
       <th>用户名</th>
       <th>注册邮箱</th>
       <th>资源数量</th>
       <th>用户身份</th>
       <th>注册时间</th>
    </tr>

<?php

switch ($attr){
  case "all":
    $pz=PrintUserList(1,$page);
    break;
  case "admin":
    $pz=PrintUserList(2,$page);
    break;
  case "user":
    $pz=PrintUserList(3,$page);
    break;
  default:
    header("location:user.php?attr=all");
    break;
}

?>

  </table>

</div>
<?php

$nextpage=$page+1;

if($page==1){
  $prepage=1;
}else{
  $prepage=$page-1;
}

?>
<div class="paging">
<ul class="pagination">
  <li><a href="user.php?attr=<?php echo $attr; ?>&page=<?php echo $prepage; ?>">&laquo;</a></li>
<?php 
for($i=1;$i<=$pz;$i++){ 
?>
  <li><a href="user.php?attr=<?php echo $attr; ?>&page=<?php $i ?>"><?php echo $i; ?></a></li>
<?php
}
?>
  <li><a href="user.php?attr=<?php echo $attr; ?>&page=<?php echo $prepage; ?>">&raquo;</a></li>
</ul>
</div>

   <div class="panel panel-default">
         <div class="panel-body">
         <div id="panel-col-left">

         <div class="navbar-form">
         <form method="POST" action="user.php?attr=<?php if(strlen($attr)==0){$attr="all";}echo $attr; ?>&page=<?php if(strlen($page)==0){$page=1;}echo $page; ?>">
         <select  class="form-control input-sm" name="adminevent">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
              <option value="forbidden">禁言</option>
         </select>
         <button type="submit" name="delORforb" value="delORforb" class="btn btn-default btn-sm" id="speace">应用</button>
         </form>
         </div>

         </div>

         </div>
    </div>

   </div>

</div>

<?php include('footer.php'); ?>