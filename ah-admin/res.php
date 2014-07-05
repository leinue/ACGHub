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
  <!-- Default panel contents -->
  <div class="panel-heading"><span id="user-op"><a href="#">全部（2000）</a></span> | <span id="user-op"><a href="#">脚本</a></span> | <span id="user-op"><a href="#">分镜</a></span> | <span id="user-op"><a href="#">设定</a></span> | <span id="user-op"><a href="#">代码</a></span> | <span id="user-op"><a href="#">音乐</a></span></div>

  <!-- Table -->
  <table class="table table-striped">

    <tr>
       <th><input type="checkbox" value=""></th>
       <th>资源名称</th>
       <th>作者</th>
       <th>作者身份</th>
       <th>上传时间</th>
    </tr>
    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 85</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

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