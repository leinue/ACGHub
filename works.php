<?php include('header.php'); 

function PrintProRecommended($method){

$reco=new RecommendWorks($method);
$reco->InitializeRecommendedItem();
$itemcnt=0;

if(count($reco->newitemmarks)!=0){

foreach ($reco->newitemmarks as $key => $marks) {
	if(strlen(strip_tags($reco->newitemdes[$key]))>100){
		$reco->newitemdes[$key]=substr(strip_tags($reco->newitemdes[$key]), 0,100)."...";
	}

	if(count($reco->newitemmarks)<=3){
		echo '<div class="acg-item">
<div class="item-head">
    <p id="item-head-title"><a href="item.php?name='.$reco->newitemname[$key].'&uid='.$reco->newitemuid[$key].'">'.$reco->newitemname[$key].'</a></p>
</div>
<div class="item-body">
<p>'.$reco->newitemdes[$key].'</p>
</div>
<div class="item-foot">
<span class="glyphicon glyphicon-folder-open" id="col-icon"> '.$reco->newitemnum[$key].'</span>
<span class="glyphicon glyphicon-user" id="col-icon"> <a href="user.php?uid='.$reco->newitemuid[$key].'" target="_blank">'.$reco->newitemeditor[$key].'</a></span>
</div>
</div>';
	}else{
		echo '<div class="acg-item">
<div class="item-head">
    <p id="item-head-title"><a href="item.php?name='.$reco->newitemname[$key].'&uid='.$reco->newitemuid[$key].'">'.$reco->newitemname[$key].'</a></p>
</div>
<div class="item-body">
<p>'.$reco->newitemdes[$key].'</p>
</div>
<div class="item-foot">
<span class="glyphicon glyphicon-folder-open" id="col-icon"> '.$reco->newitemnum[$key].'</span>
<span class="glyphicon glyphicon-user" id="col-icon"> <a href="user.php?uid='.$reco->newitemuid[$key].'" target="_blank">'.$reco->newitemeditor[$key].'</a></span>
</div>
</div>';
       $itemcnt+=1;
       if($itemcnt==3){
       	break;
       }
	}
}	
}else{
	for ($i=0; $i<3; $i++) { 
		echo '<div class="acg-item">
<div class="item-head">
    <p id="item-head-title"><a href="">资料暂缺</a></p>
</div>
<div class="item-body">
<p>资料暂缺</p>
</div>
<div class="item-foot">
<span class="glyphicon glyphicon-folder-open" id="col-icon"> 资料暂缺</span>
<span class="glyphicon glyphicon-user" id="col-icon"> <a href="" target="_blank">资料暂缺</a></span>
</div>
</div>';
	}
}
}

function CataIslegal($cata){
	switch ($cata) {
		case "music":
			return true;
			break;
		case "code":
		    return true;
		    break;
		case "script":
		    return true;
		    break;
		case "enactment":
		    return true;
		    break;
		case "dubbing":
		    return true;
		    break;
		case "storyboard":
		    return true;
		    break;
		default:
			return false;
			break;
	}
}

$cata_=test_input($_GET['cata']);

if(CataIslegal($cata_)==false){

?>

<div class="acg-works-left">

<div class="acg-script">
<p id="e-col-first"><span class="glyphicon glyphicon-book" id="col-icon"></span> <a href="works.php?cata=script">脚本</a></p>

<?php
PrintProRecommended(1);
?>

</div>

<div class="acg-storyboard">
<p id="e-col"><span class="glyphicon glyphicon-facetime-video" id="col-icon"></span> <a href="works.php?cata=storyboard">分镜</a></p>
<?php
PrintProRecommended(2);
?>
</div>

<div class="acg-people">
<p id="e-col"><span class="glyphicon glyphicon-globe" id="col-icon"></span> <a href="works.php?cata=enactment">设定</a></p>
<?php
PrintProRecommended(3);
?>
</div>

<div class="acg-code">
<p id="e-col"><span class="glyphicon glyphicon-file" id="col-icon"></span> <a href="works.php?cata=code">代码</a></p>
<?php
PrintProRecommended(4);
?>
</div>

<div class="acg-dubbing">
<p id="e-col"><span class="glyphicon glyphicon-headphones" id="col-icon"></span> <a href="works.php?cata=dubbing">配音</a></p>
<?php
PrintProRecommended(5);
?>
</div>

<div class="acg-dubbing">
<p id="e-col"><span class="glyphicon glyphicon-music" id="col-icon"></span> <a href="works.php?cata=music">音乐</a></p>
<?php
PrintProRecommended(6);
?>
</div>


</div>

<div class="acg-works-right">

<div class="acg-dubbing">

<p id="e-col-first"><span class="glyphicon glyphicon-transfer" id="col-icon"></span> 推荐</p>

<div class="acg-right-item">
<?php
$whomarks=new RecommendWorks(0);
$itemmem=count($whomarks->itemwholemarks);
$wholecnt=0;
if($itemmem!=0){
	if($itemmem<=5){
		foreach ($whomarks->itemwholemarks as $key => $marks){
			echo '<div class="acg-recommend">
    <div class="acg-reced-title">
    	<span class="acg-reced-title-obj"><a href="item.php?name='.$whomarks->itemname[$key].'&uid='.$whomarks->itemuid[$key].'">'.$whomarks->itemname[$key].'</a></span>
    </div>
</div>';
		}
	}elseif($itemmem>5){
		foreach ($whomarks->itemwholemarks as $key => $marks){
		echo '<div class="acg-recommend">
    <div class="acg-reced-title">
    	<span class="acg-reced-title-obj"><a href="item.php?name='.$whomarks->itemname[$key].'&uid='.$whomarks->itemuid[$key].'">'.$whomarks->itemname[$key].'</a></span>
    </div>
</div>';
       $wholecnt+=1;
       if($wholecnt==5){
       	break;
       }
   }
	}

}else{
	for ($i=0;$i<5;$i++) { 
		echo '<div class="acg-recommend">
    <div class="acg-reced-title">
    	<span class="acg-reced-title-obj"><a href="">资料暂缺</a></span>
    </div>
</div>';
	}
}
?>
</div>

</div>

</div>
<?php
}else{
	switch ($cata_) {
		case "music":
			
			break;
		case "code":
		    
		    break;
		case "script":
?>
<div class="overitem">

<div class="newest-submit">
<p id="e-col-newest"><span class="glyphicon glyphicon-repeat" id="col-icon"></span> <a href="works.php?cata=music">最新投稿</a></p>

  <div class="page-col"><a href=""><span class="glyphicon glyphicon-circle-arrow-right"></span></a></div>
  <div class="page-col"><a href=""><span class="glyphicon glyphicon-circle-arrow-left"></span></a></div>  

<?php

$script_repo=new RecommendWorks(1);
$scriptcnt=0;

foreach ($script_repo->itemtime as $timekey => $itime) {
  if($scriptcnt<3){
	echo '<div class="the-top-three">
    <div class="the-top-three-content">
    <span><a href="item.php?name='.$script_repo->itemname[$timekey].'&uid='.$script_repo->itemuid[$timekey].'" target="_blank">'.$script_repo->itemname[$timekey].'</a></span>
    </div>
    <div class="the-top-three-footer">
    <a href="user.php?uid='.$script_repo->itemuid[$timekey].'" target="_blank">'.$script_repo->itemeditor[$timekey].'</a>
    </div>
  </div>';
    $scriptcnt+=1;
  }
  else{
  	$nextpos=array_search(next($script_repo->itemtime),$script_repo->itemtime);
  	echo '<div class="the-normal-list">
    <div class="normal-header">
      <div class="normal-content"><a href="item.php?name='.$script_repo->itemname[$timekey].'&uid='.$script_repo->itemuid[$timekey].'" target="_blank">'.$script_repo->itemname[$timekey].'</a></div>
      <div class="normal-editor"><a href="user.php?uid='.$script_repo->itemuid[$timekey].'" target="_blank">'.$script_repo->itemeditor[$timekey].'</a></div>
    </div>
    <div class="normal-footer">
      <div class="normal-content"><a href="item.php?name='.$script_repo->itemname[$nextpos].'&uid='.$script_repo->itemuid[$timekey].'" target="_blank">'.$script_repo->itemname[$nextpos].'</a></div>
      <div class="normal-editor"><a href="user.php?uid='.$script_repo->itemuid[$nextpos].'" target="_blank">'.$script_repo->itemeditor[$nextpos].'</a></div>
    </div>
  </div>';
    $scriptcnt+=1;
    if($scriptcnt==8){break;}
  }
}

?>

</div>

<div class="rank">
<p id="e-col-newest"><span class="glyphicon glyphicon-fire" id="col-icon"></span> <a href="works.php?cata=music">排行榜 Top 10</a></p>

<?php

$script_repo->InitializeRecommendedItem();
$markcnt=0;
$arrmarkcnt=count($script_repo->newitemmarks);
$rankitemname=array();

foreach ($script_repo->newitemmarks as $markkey => $imark){
if($arrmarkcnt!=0){

	if($markcnt<3){
		echo '<div class="the-top-three">

    <div class="the-top-three-content">
    <span><a href="item.php?name='.$script_repo->newitemname[$markkey].'&uid='.$script_repo->newitemuid[$markkey].'" target="_blank">'.$script_repo->newitemname[$markkey].'</a></span>
    </div>

    <div class="the-top-three-footer">
    <a href="user.php?uid='.$script_repo->newitemuid[$markkey].'" target="_blank">'.$script_repo->newitemeditor[$markkey].'</a>
    </div>

  </div>';
       $markcnt=$markcnt+1;
	}elseif ($markcnt>=3 and $markcnt<8){

		echo '  <div class="normal-list-long">
      <div class="normal-content"><a href="item.php?name='.$script_repo->newitemname[$markkey].'&uid='.$script_repo->newitemuid[$markkey].'" target="_blank">'.$script_repo->newitemname[$markkey].'</a></div>
      <div class="normal-editor"><a href="user.php?uid='.$script_repo->newitemuid[$markkey].'" target="_blank">'.$script_repo->newitemeditor[$markkey].'</a></div>
  </div>';
        $markcnt=$markcnt+1;
        if($markcnt>=8){
        	$nextpos=array_search(next($script_repo->newitemmarks),$script_repo->newitemmarks);
        	if($arrmarkcnt>=9){
        		$rankitemname[0]=$script_repo->newitemname[$markkey];
        		$rankitemname[1]="暂无数据";
        	}else{
        		$rankitemname[0]=$script_repo->newitemname[$markkey];
        		$rankitemname[1]=$script_repo->newitemname[$nextpos];
        	}
           echo '  <div class="normal-list-long">
  <div class="normal-list-long-header">
      <div class="normal-content"><a href="item.php?name='.$script_repo->newitemname[$markkey].'&uid='.$script_repo->newitemuid[$markkey].'">'.$rankitemname[0].'</a></div>
      <div class="normal-editor"><a href="user.php?uid='.$script_repo->newitemuid[$markkey].'">'.$script_repo->newitemeditor[$markkey].'</a></div>
  </div>
  <div class="normal-list-long-right">
      <div class="normal-content"><a href="item.php?name='.$script_repo->newitemname[$nextpos].'&uid='.$script_repo->newitemuid[$nextpos].'">'.$rankitemname[1].'</a></div>
      <div class="normal-editor"><a href="user.php?uid='.$script_repo->newitemuid[$nextpos].'">'.$script_repo->newitemeditor[$nextpos].'</a></div>
  </div>
  </div>';
        $markcnt=$markcnt+1;
        if ($markcnt==10) {break;}	
        }
	}

}else{echo '暂无数据';}

}
?>

</div>

</div>
<?php
		    break;
		case "enactment":
		    
		    break;
		case "dubbing":
		    
		    break;
		case "storyboard":
		    
		    break;
	}
}
?>


<?php include('footer.php'); ?>