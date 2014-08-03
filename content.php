<?php 
error_reporting(E_ALL & ~E_DEPRECATED);
error_reporting(E_ALL & ~E_NOTICE);

connect_mysql();

    $sql="SELECT `id` FROM `acghub_member` WHERE `email`='".$_SESSION['user-account']."'";
    $res=getone($sql);

     if($_SESSION['user-login-id']!=1){

?>
<main>
	<div class="row">
		<div class="col-lg-8 col-lg-push-2">
		    
		<h1 class="blog-title">
			<a href="/">从这里更好的发布你的创意</a>
		</h1>
		<h2 class="blog-desc">
			<a href="/">ԅ(¯ㅂ¯ԅ) 剧本 分镜 设定 代码 配音<span class="glyphicon glyphicon-send"></span></a>
		</h2>
        
		</div>
    </div>
    
	<div class="row">
    
        <div class="col-md-8 col-md-offset-2" id="ad">
        
        <div class="col-md-6" id="one-half-right">
        
        <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-front">
        
        </div>
        <div class="col-md-6" id="one-half-botttom">
         
         <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-front">
  
        </div>
        
        <div class="col-md-6" id="one-half-right-none-bottom">
        
         <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-bottom">
         
        </div>
        
        <div class="col-md-6">
        
         <img src="http://i60.tinypic.com/4h4fn4.jpg" alt="wennai" class="img-thumbnail" id="img-bottom">
         
        </div>
             
       </div>
    </div>

</main>
    <?php
    }
    else{
    ?>
<main>
<div class="user-per">

<div class="trends">

<div class="list-group">
  <a class="list-group-item">Cras justo odio</a>
  <a class="list-group-item">Dapibus ac facilisis in</a>
  <a class="list-group-item">Morbi leo risus</a>
  <a class="list-group-item">Porta ac consectetur ac</a>
  <a class="list-group-item">Vestibulum at eros</a>
<ul class="pager">
  <li class="previous"><a href="#">&larr; Older</a></li>
  <li class="next"><a href="#">Newer &rarr;</a></li>
</ul>
</div>


<a href="#dypage"></a>
<div class="list-group">
<?php

$tr=ReadDyn($_SESSION['user-account']);
$tr_re=array_reverse($tr);
$itemcount=count($tr_re);

$pagesize=ceil($itemcount/10);

$Personal_Current_Page=test_input($_GET['dypage']);

if($Personal_Current_Page>$pagesize or !(is_numeric($Personal_Current_Page))){
  header("location:index.php?dypage=".$pagesize);}

if(strlen($Personal_Current_Page)==0){
  $Personal_Current_Page=1;}

if($Personal_Current_Page==$pagesize){
  $Personal_Next_Page=$pagesize;
}else{
  $Personal_Next_Page=$Personal_Current_Page+1;}

$startkey=($Personal_Current_Page*5)+((5*($Personal_Current_Page))-10);
$endkey=$startkey+10;

if($endkey>$itemcount){
  $tmp=$endkey-$itemcount;
  $endkey=$endkey-$tmp;
}

for($i=$startkey;$i<$endkey;$i++){ 
  $stime=substr($tr_re[$i], 0,19);
  $ts=GetTimeStamp($stime);

  $vasub=substr($tr_re[$i], 19);
  echo '  <a class="list-group-item">
    <h4 class="list-group-item-heading">'.$vasub.'</h4>
    <p class="list-group-item-text">'.$ts.'前</p>
  </a>';
}

?>
<ul class="pagination">
  <li><a href="index.php?dypage=<?php if($Personal_Current_Page==1){echo '1';}else{echo $Personal_Current_Page-1;} ?>">&laquo;</a></li>
  <?php
  for($i=1;$i<=$pagesize;$i++){
  ?>
  <li><a href="index.php?dypage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php
  }
  ?>
  <li><a href="index.php?dypage=<?php echo $Personal_Next_Page; ?>">&raquo;</a></li>
</ul>
</div>


</div>

<div class="res-right">

<div class="panel panel-default">

  <div class="panel-heading">
  <div class="row">
  <div class="col-lg-12">
  <form method="POST" action="search.php" name="search_input">
    <div class="input-group">
      <input type="text" name="searchform" class="form-control" placehold="请输入资源名称">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="searchbtn" value="searchbtn">搜索资源</button>
      </span>
    </div><!-- /input-group -->
    </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
  </div>


  <div class="panel-body">
    <ul class="nav nav-tabs" role="tablist" id="mytab">
     <li class="active"><a href="#all" role="tab" data-toggle="tab">全部</a></li>
     <li><a href="#public" role="tab" data-toggle="tab">公共</a></li>
     <li><a href="#private" role="tab" data-toggle="tab">私有</a></li>
     <li><a href="#fork" role="tab" data-toggle="tab">关注</a></li>
    </ul>
  </div>

  <div class="tab-content">

  <div class="tab-pane fade active in" id="all">

  <div class="panel-res">
  <div class="list-group">
  <?php

    if($res!=false){
      if(file_exists("userpro/".$res)){
      $mulu = scandir("userpro/".$res);
      $a = count($mulu);
      if($a>2){
        for($i = 2;$i<=$a-1;$i++){
        echo '<a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$res.'" target="_blank"><li class="list-group-item">'.iconv('gbk','utf-8',$mulu[$i]).'</li></a>';
        }
      }
      else{
        echo '<li class="list-group-item">暂无数据</li>';
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
    }
    else {echo '<li class="list-group-item">数据库错误</li>';}

    function echo_item_pu_pr($res,$type){
      if($res!=false){
    if(file_exists("userpro/".$res)){
      $mulu=scandir("userpro/".$res);
      $a=count($mulu);
      if($a>2){
        $cnt=0;
        for($i = 2;$i<=$a-1;$i++){
          $filename = "userpro/".$res."/".$mulu[$i]."/prosetting.afg";
          $handle = fopen($filename, "r");
          $contents = fread($handle, filesize ($filename));
          fclose($handle);

          $protype=explode("\r\n", $contents);

          if($protype[0]==$type){
            $cnt+=1;
              echo '<a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$res.'" target="_blank"><li class="list-group-item">'.iconv('gbk','utf-8',$mulu[$i]).'</li></a>';
          }
          else{
            break;
             //echo '<a href="item.php?name='.iconv('gbk','utf-8',$mulu[$i]).'&uid='.$res.'" target="_blank"><li class="list-group-item">'.iconv('gbk','utf-8',$mulu[$i]).'</li></a>';
          }
        }

      }
      else{
        echo '<li class="list-group-item">暂无数据</li>';
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


    }
    else{echo '<li class="list-group-item">数据库错误</li>';}
}

  ?>
  </div>
  </div>

  </div>

  <div class="tab-pane fade" id="public">

  <div class="panel-res">
  <ul class="list-group">
  <?php
  echo_item_pu_pr($res,"type=public");

  ?>
  </ul>
  </div>

  </div>

  <div class="tab-pane fade" id="private">
  <div class="panel-res">
  <ul class="list-group">
  <?php
  echo_item_pu_pr($res,"type=private");
  ?>
  </ul>
  </div>
  </div>

  <div class="tab-pane fade" id="fork">

  <div class="panel-res">
  <ul class="list-group">
  <?php

  ?>
  </ul>
  </div>

  </div>

  </div>

</div>

</div>

</div>
</main>
    <?php
    }
    ?>