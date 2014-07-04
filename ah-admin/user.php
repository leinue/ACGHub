<?php include('header.php'); ?>


<div class="user-content" id="user-body">

   <div class="user-content-main">

   <div class="panel panel-default">
         <div class="panel-body">

         <form class="navbar-form" role="search" id="panel-search-right">
         <div class="form-group">
         <input type="text" class="form-control" placeholder="用户搜索">
         </div>
         <button type="submit" class="btn btn-default">搜索</button>
         </form>

         <div id="panel-col-left">

         <div class="navbar-form">

         <select class="form-control input-sm">
              <option value="operate">批量操作</option>
              <option value="delete">删除</option>
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
  <!-- Default panel contents -->
  <div class="panel-heading"><span id="user-op"><a href="#">全部用户（2000）</a></span> | <span id="user-op"><a href="#">管理员（1）</a></span> | <span id="user-op"><a href="#">普通用户（1999）</a></span></div>

  <!-- Table -->
  <table class="table table-striped">

    <tr>
       <th><input type="checkbox" value=""></th>
       <th>用户名</th>
       <th>注册邮箱</th>
       <th>资源数量</th>
       <th>用户身份</th>
       <th>注册时间</th>
    </tr>
    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 85</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
       <td>555 77 855</td>
    </tr>

    <tr>
       <td><input type="checkbox" value=""></td>
       <td>Bill Gates</td>
       <td>555 77 854</td>
       <td>555 77 855</td>
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