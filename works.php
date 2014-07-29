<?php include('header.php'); ?>

<div class="acg-works-left">

<div class="acg-script">
<p id="e-col-first"><span class="glyphicon glyphicon-book" id="col-icon"></span> 脚本</p>

<?php
//echo GetProNum("userpro/15/dyntest2");
$reco=new RecommendWorks(1);
$reco->InitializeRecommendedItem();

foreach ($reco->newitemmarks as $key => $marks) {
	if(count($reco->newitemmarks)<=3){
		echo '<div class="acg-item">
<div class="item-head">
    <p id="item-head-title"><a href="item.php?name='.$reco->newitemname[$key].'&uid='.$reco->newitemuid[$key].'">'.$reco->newitemname[$key].'</a></p>
</div>
<div class="item-body">
<p>All the icons you could dream of all wrapped up nice and neatly as web fonts.</p>
</div>
<div class="item-foot">
<span class="glyphicon glyphicon-folder-open" id="col-icon"> '.$reco->newitemnum[$key].'</span>
<span class="glyphicon glyphicon-user" id="col-icon"> <a href="user.php?uid='.$reco->newitemuid[$key].'" target="_blank">'.$reco->newitemeditor[$key].'</a></span>
</div>
</div>';
	}else{

	}
}

?>

</div>

<div class="acg-storyboard">
<p id="e-col"><span class="glyphicon glyphicon-facetime-video" id="col-icon"></span> 分镜</p>
<div class="acg-item">

</div>

<div class="acg-item">

</div>

<div class="acg-item">

</div>
</div>

<div class="acg-people">
<p id="e-col"><span class="glyphicon glyphicon-globe" id="col-icon"></span> 设定</p>
<div class="acg-item">

</div>

<div class="acg-item">

</div>

<div class="acg-item">

</div>
</div>

<div class="acg-code">
<p id="e-col"><span class="glyphicon glyphicon-file" id="col-icon"></span> 代码</p>
<div class="acg-item">

</div>

<div class="acg-item">

</div>

<div class="acg-item">

</div>
</div>

<div class="acg-dubbing">
<p id="e-col"><span class="glyphicon glyphicon-headphones" id="col-icon"></span> 配音</p>
<div class="acg-item">

</div>

<div class="acg-item">

</div>

<div class="acg-item">

</div>
</div>

<div class="acg-dubbing">
<p id="e-col"><span class="glyphicon glyphicon-music" id="col-icon"></span> 音乐</p>
<div class="acg-item">

</div>

<div class="acg-item">

</div>

<div class="acg-item">

</div>
</div>


</div>

<div class="acg-works-right">

<div class="acg-dubbing">

<p id="e-col-first"><span class="glyphicon glyphicon-transfer" id="col-icon"></span> 推荐</p>

<div class="acg-right-item">

<div class="acg-recommend">
    <div class="acg-reced-title">
    	<span class="acg-reced-title-obj"><a href="#">xxxxxxxxxx</a></span>
    </div>
</div>

<div class="acg-recommend">
	
</div>
<div class="acg-recommend">
	
</div>
<div class="acg-recommend">
	
</div>
<div class="acg-recommend">
	
</div>


</div>

</div>

</div>

<?php include('footer.php'); ?>