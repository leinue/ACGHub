<?php 
include('header.php');
?>

<?php 

$ccf=new DBConcerningForking();


connect_mysql();
     if($_SESSION['user-login-id']==1){
      $user_uid=test_input($_GET['uid']);

      if(strlen($user_uid)!=0){
        $sql_detail="SELECT `name`,`email`, `_date`,`website`, `location` FROM `acghub_member` WHERE `id`=".$user_uid;
        $res_detail=mysql_query($sql_detail);
        if($res_detail!=false){
          $row=mysql_fetch_row($res_detail);
            /*[0] => ivy
              [1] => 597055914@qq.com
              [2] => 2010
              [3] => www.ivydom.com
              [4] => tianchao*/
        }
        else{
          echo '数据库出错';
        }
      }
      else{

        $getid="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
        $wuid=getone($getid);
        if($wuid!=false){
          header("location:user.php?uid=$wuid");
        }
        else{echo '数据库错误';}
      }
      
?>

<div class="user-per">

  <div class="user-info">

    <div class="user-photo">

    <?php

    $very_sql="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
    $very_res=getone($very_sql);
    if($very_res!=false){
      if($very_res==$user_uid){
        $picsrc=GetPhoDir($_SESSION['user-account']);
        echo '<img alt="" src="'.$picsrc.'" width=250 height=250>';
      }
      else{
        $other_sql="SELECT `email` FROM `acghub_member` WHERE `id`=".$user_uid;
        $other_res=getone($other_sql);
        if($other_res!=false){
          $picsrc=GetPhoDir($other_res);
          echo '<img alt="" src="'.$picsrc.'" width=250 height=250>';
        }else{echo '数据库出错';}
      }

    }else{echo '数据库出错';}

    ?>

    </div>

    <div class="user-name">
    <h3><?php echo $row[0]; ?></h3>
    </div>

    <div class="split-col"></div>

    <div class="user-detail">
    <p><span class="glyphicon glyphicon-map-marker" id="user-detail-icon"></span> <?php echo $row[4]; ?></p>
    <p><span class="glyphicon glyphicon-envelope" id="user-detail-icon"></span> <a class="email" href="mailto:<?php echo $row[1]; ?>"><?php echo $row[1]; ?></a></p>
    <p><span class="glyphicon glyphicon-link" id="user-detail-icon"></span> <a href="<?php if(substr($row[3], 0,7)!="http://"){$row[3]="http://".$row[3];echo $row[3];}else{echo $row[3];} ?>" target="_blank"><?php echo $row[3]; ?></a></p>
    <p><span class="glyphicon glyphicon-log-in" id="user-detail-icon"></span> <?php echo $row[2]; ?></p>
    </div>

    <div class="split-col"></div>

    <div class="social-relations">
    <div class="row">

      <div class="col-md-4">
      <h3>1000</h3>
      <span class="help-block">关注</span>
      </div>
      <div class="col-md-4">
      <h3>1000</h3>
      <span class="help-block">收藏</span>
      </div>
      <div class="col-md-4">
      <h3>845</h3>
      <span class="help-block">粉丝</span> 
      </div>
    </div>
  
    </div>

    <div class="split-col"></div>

  </div>

  <div class="res-info">

  <div class="panel-body">
    <ul class="nav nav-tabs" role="tablist" id="mytab">
     <li class="active"><a href="#all" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-zoom-in"></span> 全部</a></li>
     <li><a href="#public" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-eye-open"></span> 公共</a></li>
     <li><a href="#private" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-eye-close"></span> 私有</a></li>
     <li><a href="#fork" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-heart"></span> 关注</a></li>
     <li><a href="#activity" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-send"></span> 动态</a></li>
    </ul>
  </div>

  <div class="tab-content">

  <div class="tab-pane fade active in" id="all">

  <div class="panel-act">

  <div class="panel-header">
   <div class="input-group-left">
   <form action="search.php" method="POST" name="searchform">
    <div class="input-group">
      <input type="text" class="form-control" name="searchform" placeholder="请输入搜索内容">
      <span class="input-group-btn">
        <button class="btn btn-default" name="btnsea" value="btnsea" type="submit">搜索</button>
      </span>
    </div><!-- /input-group -->
    </form>

    <div class="res-split-col"></div>
   </div>

   <div class="input-group-right">
   <?php
   if($user_uid==GetUid($_SESSION['user-account'])){
   ?>
   <a href="create.php" target="_blank"><button type="button" class="btn btn-default">创建</button></a>
   <?php
   }else{
   ?>
   <button type="button" class="btn btn-default">关注</button>
   <?php
   }
   ?>
       
   </div>

   </div>

    <br>
     
     <div class="panel-body">

     <?php

     if(file_exists("userpro/".$user_uid)){

      $mulu = scandir("userpro/".$user_uid);
      $a = count($mulu);
      if($a>2){
        for($i = 2;$i<=$a-1;$i++){
          $filename = "userpro/".$user_uid."/".$mulu[$i]."/readme";
          $handle = fopen($filename, "r");
          if($handle!=""){
            //$contents = fread($handle, filesize ($filename));
            //fclose($handle);

            //$contents=substr($contents,0);
            //$contents=iconv("GB2312","UTF-8//IGNORE",$contents);


            echo '<div class="panel-body-item">

     <div class="panel-body-title">
     <a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$user_uid.'" target="_blank"><h2><span class="glyphicon glyphicon-list-alt"></span> '.iconv('gbk','utf-8',$mulu[$i]).'</h2></a>
     </div>

     <div class="panel-body-content">
     <h4></h4>
     </div>

     <div class="panel-body-content">
     <span class="help-block">最后一次更新:'.WriteTimeStamp($_SESSION['user-account'],iconv('gbk','utf-8',$mulu[$i])).'前</span> 
     </div>

     </div>';

          }else{
            echo '<div class="panel-body-item">

     <div class="panel-body-title">
     <a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$user_uid.'" target="_blank"><h2><span class="glyphicon glyphicon-list-alt"></span> '.iconv('gbk','utf-8',$mulu[$i]).'</h2></a>
     </div>

     <div class="panel-body-content">
     <h4>'.iconv('gbk','utf-8',$mulu[$i]).' proect</h4>
     </div>

     <div class="panel-body-content">
     <span class="help-block">最后一次更新:'.WriteTimeStamp($_SESSION['user-account'],iconv('gbk','utf-8',$mulu[$i])).'前</span> 
     </div>

     </div>';
          }
        }
      }
      else{
        echo '暂无数据';
        if($a-1==1){

        }
        else{
          break;
        }
      }
    }
    else{
      die();
    }

      function echopupr($uid,$type){
      $mulu=scandir("userpro/".$uid);
      $a=count($mulu);
      if($a>2){
      for($i = 2;$i<=$a-1;$i++){
          $filename = "userpro/".$uid."/".$mulu[$i]."/prosetting.afg";
          $handle = fopen($filename, "r");
          $contents = fread($handle, filesize ($filename));
          fclose($handle);
          $protype=explode("\r\n", $contents);
          if($protype[0]==$type){
            $readme = "userpro/".$uid."/".$mulu[$i]."/readme";
            $hand = fopen($readme, "r");
            if($hand!=""){
            //$contents = fread($hand, filesize ($readme));
            //fclose($hand);
            //$contents=substr($contents,0);
            //$contents=iconv("GB2312","UTF-8//IGNORE",$contents);

            echo '<div class="panel-body-item">

     <div class="panel-body-title">
     <a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$uid.'" target="_blank"><h2><span class="glyphicon glyphicon-list-alt"></span> '.iconv('gbk','utf-8',$mulu[$i]).'</h2></a>
     </div>

     <div class="panel-body-content">
     <h4></h4>
     </div>

     <div class="panel-body-content">
     <span class="help-block">最后一次更新:'.WriteTimeStamp($_SESSION['user-account'],iconv('gbk','utf-8',$mulu[$i])).'前</span> 
     </div>

     </div>';
          }
          else{
            echo '<div class="panel-body-item">

     <div class="panel-body-title">
     <a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$uid.'" target="_blank"><h2><span class="glyphicon glyphicon-list-alt"></span> '.iconv('gbk','utf-8',$mulu[$i]).'</h2></a>
     </div>

     <div class="panel-body-content">
     <h4>'.$mulu[$i].' proect</h4>
     </div>

     <div class="panel-body-content">
     <span class="help-block">最后一次更新:'.WriteTimeStamp($_SESSION['user-account'],iconv('gbk','utf-8',$mulu[$i])).'前</span> 
     </div>

     </div>';
          }
          }
          else{
            //echo '暂无数据';
            break;
          }

      }
      }
      else{echo '暂无数据';}
    }
     ?>

     </div>

  </div>

  </div>

  <div class="tab-pane fade" id="public">
  <div class="panel-act">
     <div class="panel-body">
<?php
     echopupr($user_uid,"type=public");
?>
     </div>

    </div>

  </div>

  <div class="tab-pane fade" id="private">
  <div class="panel-act">
     <div class="panel-body">

<?php
     echopupr($user_uid,"type=private");
?>

     </div>
  </div>
  </div>

  <div class="tab-pane fade" id="fork">

  <div class="panel-act">
     <div class="panel-body">
<?php
    $rfw=GetForkedPronameByuid($user_uid);
    $rfwuid=GetForkeduidByuid($user_uid);

    foreach ($rfw as $rfwkey => $rfwvalue) {
      /*$rfwdes=GetDes("userpro/".$user_uid."/".$rfwvalue."/readme");
      if(!$rfwdes){
        $rfwdes=$rfwvalue." Project";
      }*/
      echo '<div class="panel-body-item">
     <div class="panel-body-title">
     <h2><span class="glyphicon glyphicon-list-alt"></span> <a href="item.php?name='.$rfwvalue.'&uid='.$rfwuid[$rfwkey].'" target="_blank">'.$rfwvalue.'</a></h2>
     </div>
     
     <div class="panel-body-content">
     <span class="help-block">最后一次更新:20分钟前</span> 
     </div>
     </div>';
    }

    /*<div class="panel-body-content">
     <h4>'.$rfwdes.'</h4>
     </div>*/
?>
     </div>
  </div>

  </div>

  <div class="tab-pane fade" id="activity">

  <div class="act-item">
  <div class="row">
  <div class="col-md-6">
    <div class="act-item-left">
  <h2><span class="glyphicon glyphicon-refresh"></span></h2>
  </div>

  <div class="act-item-right">

  <div class="act-time">
  <span class="help-block">最后一次更新:20分钟前</span> 
  </div>

  <div class="act-item-title">
  <p><a href="#">leinue</a> pushed to <a href="#">leinue/ACGHub</a></p>
  </div>

  <div class="act-item-detail">
  <p>增加前台资源管理面板及相关CSS/JS </p>
  </div>

  </div>
</div>
</div>

  </div>

    <div class="act-item">
  <div class="row">
  <div class="col-md-6">
    <div class="act-item-left">
  <h2><span class="glyphicon glyphicon-refresh"></span></h2>
  </div>

  <div class="act-item-right">

  <div class="act-time">
  <span class="help-block">最后一次更新:20分钟前</span> 
  </div>

  <div class="act-item-title">
  <p><a href="#">leinue</a> pushed to <a href="#">leinue/ACGHub</a></p>
  </div>

  <div class="act-item-detail">
  <p>增加前台资源管理面板及相关CSS/JS </p>
  </div>

  </div>
</div>
</div>

  </div>


  </div>

  </div>

</div>

  </div>

</div>

<?php
}
else
{
  header("location:index.php");
}
?>
<?php include('footer.php'); ?>