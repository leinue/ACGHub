<?php
include('header.php');

function GetDes($filename){
      //$mulu=scandir($path);
      //$a=count($mulu);
      //if($a>2){
        //for($i = 2;$i<=$a-1;$i++){
          //$handle = fopen($filename, "r");
          //$contents = fread($handle, filesize ($filename));
          //fclose($handle);
	if(file_exists($filename)){
		$opts = array('file' => array('encoding' => 'gb2312'));
        $ctxt = stream_context_create($opts);
        $contents=file_get_contents($filename, FILE_TEXT, $ctxt); 
        $contents = iconv("gb2312", "utf-8//IGNORE",$contents); 
        return $contents;
	}
	else{
		echo false;
	}
}

function GetItem($list){
	$mulu = scandir($list);
    $count = count($mulu);
    if($count>2){
    	return $mulu;
    }
    else{return false;}
}

$itemname=test_input($_GET['name']);
$uid=test_input($_GET['uid']);

if($_SESSION['user-login-id']==1){

?>

<div class="overitem">

<div class="item-left">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $itemname; ?></h3>
  </div>
  <div class="panel-body">
<?php

if(strlen($itemname)!=0 and strlen($uid)!=0){

	$des=GetDes("userpro/".$uid."/".$itemname."/readme");

	if($des!=false){
		echo $des;
	}
	else{echo $itemname.'project';}
}

?>
   
  </div>

   <table class="table" id="table-size">

    <tr>
    <th>文件</th>
    <th>详细</th>
    <th>时间</th>
    </tr>
    
<?php
   $conlist=GetItem("userpro/".$uid."/".$itemname);
   $a=count($conlist);
   if($conlist!=false){
   for($i = 2;$i<=$a-1;$i++){
   	if($conlist[$i]!="prosetting.afg" and $conlist[$i]!="readme"){
   	   	echo '<tr>
    <td>'.iconv('gbk','utf-8',$conlist[$i]).'</td>
    <td>'.$des.'</td>
    <td>1分钟以前</td>
    </tr>';
    }
    else{
    	continue;
    }
   }
   }
   else{
   	echo '';
   }
?>
    

  </table>

</div>

</div>

<div class="item-right">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>

</div>

</div>

<?php

}
else{
	header('location:index.php');
}

include('footer.php');
?>