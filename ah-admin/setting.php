<?php include('header.php'); ?>
<div class="user-content" id="user-body">

   <div class="user-content-main">

   <div class="panel panel-default">

   <h2 class="setting-title">网站系统设置</h2>

   <form action="form_action.asp" method="post">

     <div class="panel-body">
      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">站点标题</span>
       <input type="text" class="form-control" placeholder="站点名称">
      </div>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">副标题</span>
       <input type="text" class="form-control" placeholder="副标题">
      </div>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">站点描述</span>
       <input type="text" class="form-control" placeholder="站点描述">
      </div>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">关键词</span>
       <input type="text" class="form-control" placeholder="关键词">
      </div>
      <span class="help-block">请用英文逗号","分隔关键字</span>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">管理员ID</span>
       <input type="text" class="form-control" placeholder="管理员ID">
      </div>
      <span class="help-block">不修改可留空</span>

      <div class="input-group" id="input-group-margin">
       <span class="input-group-addon">管理员密码</span>
       <input type="password" class="form-control" placeholder="管理员密码">
      </div>
      <span class="help-block">不修改可留空</span>

      <button type="button" class="btn btn-default">提交</button>
     </div>

   </form>

</div>
</div>
</div>
<?php include('footer.php'); ?>