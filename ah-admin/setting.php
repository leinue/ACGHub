<?php include('header.php'); 

$_profile=array();
$_profile[0]=test_input($_POST['title']);
$_profile[1]=test_input($_POST['subhead']);
$_profile[2]=test_input($_POST['description']);
$_profile[3]=test_input($_POST['keywords']);
$_profile[4]=test_input($_POST['admin-account']);
$_profile[5]=test_input($_POST['admin-password']);

$updateData=new SiteInfo();
if($updateData->UpdateProfiles($_profile,$_SESSION['admin-account'])){
  echo '修改成功';
}else{
  echo '修改失败';
}

?>

<div class="user-content" id="user-body">

   <div class="user-content-main">

   <div class="panel panel-default">

   <h2 class="setting-title">网站系统设置——欢迎 <a href="../user.php?uid=<?php echo GetUid($_SESSION['admin-account']); ?>" target="_blank"><?php echo GetName(GetUid($_SESSION['admin-account'])); ?></a></h2>
  <?php

  $sinfo=new SiteInfo();

  ?>
   <form action="setting.php" method="post">

     <div class="panel-body">
      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">站点主标题</span>
       <input name="title" type="text" class="form-control" placeholder="站点名称" value="<?php echo $sinfo->title; ?>">
      </div>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">站点副标题</span>
       <input name="subhead" type="text" class="form-control" placeholder="副标题" value="<?php echo $sinfo->subhead; ?>">
      </div>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">站点主描述</span>
       <input name="description" type="text" class="form-control" placeholder="站点描述" value="<?php echo $sinfo->description; ?>">
      </div>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">站点关键词</span>
       <input name="keywords" type="text" class="form-control" placeholder="关键词" value="<?php echo $sinfo->keywords; ?>">
      </div>
      <span class="help-block">请用英文逗号","分隔关键字</span>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">管理员名称</span>
       <input name="admin-account" type="text" class="form-control" placeholder="管理员名称">
      </div>
      <span class="help-block">不修改可留空</span>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">管理员密码</span>
       <input name="admin-password" type="password" class="form-control" placeholder="管理员密码">
      </div>
      <span class="help-block">不修改可留空</span>

      <button type="sumit" class="btn btn-default">提交</button>
     </div>

   </form>

</div>
</div>
</div>

<?php include('footer.php'); ?>