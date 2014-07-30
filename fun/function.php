<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function checkemail($email_checked){
    $sql = "select count(*) from `acghub_member` where email='".$email_checked."'";
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      return $row[0];
    }
    else{return false;}
}

function GetAllId(){
  $res_row=array();
  $count=0;
  $sql="SELECT `id` FROM `acghub_member`";
  $res=mysql_query($sql);
  if($res!=false){
    while($row=mysql_fetch_row($res)){
      $res_row[$count]=$row[0];
      $count+=1;
    }
    return $res_row;
  }else{return false;}
}

function getone($sql){
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      return $row[0];
    }
    else {return false;}
}

function GetPhoDir($email){
  $sql="SELECT `photo` FROM `acghub_member` 
  WHERE `email`='$email'";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetEmail($uid){
  $sql="SELECT `email` 
  FROM `acghub_member` WHERE `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetName($uid){
  $sql="SELECT `name` 
  FROM `acghub_member` 
  WHERE `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;} 
}

function Getuid($email){
  $sql="SELECT `id` 
  FROM `acghub_member` WHERE `email`='$email'";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetWebsite($uid){
  $sql="SELECT `website` FROM `acghub_member` 
  WHERE `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetLocation($uid){
  $sql="SELECT 
  `location` FROM 
  `acghub_member` WHERE 
  `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetAge($uid){
  $sql="SELECT `age` FROM `acghub_member` WHERE `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}  
}

function GetSex($uid){
  $sql="SELECT `sex` 
  FROM `acghub_member` WHERE `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}    
}

function SingleDecToHex($dec){
$tmp="";
$dec=$dec%16;
if($dec<10)
return $tmp.$dec;
$arr=array("a","b","c","d","e","f");
return $tmp.$arr[$dec-10];
}

function SingleHexToDec($hex){
$v=ord($hex);
if(47<$v&$v<58)
return $v-48;
if(96<$v&$v<103)
return $v-87;
}

function SetToHexString($str){
if(!$str)return false;
$tmp="";
for($i=0;$i<6;$i++) {
$ord=ord($str[$i]);
$tmp.=SingleDecToHex(($ord-$ord%16)/16);
$tmp.=SingleDecToHex($ord%16);
}
return $tmp;
}

function UnsetFromHexString($str){
if(!$str)return false;
$tmp="";
for($i=0;$i<6;$i++) {
$tmp.=chr(SingleHexToDec(substr($str,$i,1))*16+SingleHexToDec(substr($str,$i+1,1)));
}
return $tmp;
}

function delsvndir($svndir){
    $dh=opendir($svndir);
    while($file=readdir($dh)){
        if($file!="."&&$file!=".."){
            $fullpath=$svndir."/".$file;
            if(is_dir($fullpath)){
                delsvndir($fullpath);
            }else{
                unlink($fullpath);
            }
        }
        
    }
    closedir($dh);
    if(rmdir($svndir)){
        return  true;
    }else{
        return false;
    }
    
}

function WriteDyn($DynamicUser,$email){

$sql_get="SELECT `dynamic` FROM `acghub_member` WHERE `email`='".$email."'";
$get=getone($sql_get);

if($get!=false){

  if($get=="9"){
  	$get=$DynamicUser;
  }
  else{
  	$get=$get."{|---+---|}".$DynamicUser;
  }

  $sql_up="UPDATE `acghub_member` SET `dynamic`='".$get."' WHERE `email`='".$email."'";
  $res_up=mysql_query($sql_up);
  if($res_up!=false){
  $up=mysql_affected_rows();
  if($up!=-1){
    return true;
  }
  else{
    return false;
  }
 }
 else{return false;}
}
else{
  return false;
}

}

function ReadDyn($mail){
  $sql_read="SELECT `dynamic` FROM `acghub_member` WHERE `email`='".$mail."'";
  $res_read=mysql_query($sql_read);
  if($res_read!=false){
    $row_read=mysql_fetch_row($res_read);
    $fruit_dyn=explode("{|---+---|}", $row_read[0]);
    return $fruit_dyn;
  }
  else{return false;}
}

function GetTimeStamp($startdate){
  
date_default_timezone_set('Etc/GMT-8');//设置时区

$enddate = date("Y-m-d H:i:s");

$date=floor((strtotime($enddate)-strtotime($startdate))/86400);
$hour=floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
$minute=floor((strtotime($enddate)-strtotime($startdate))%86400/60);
$second=floor((strtotime($enddate)-strtotime($startdate))%86400%60);

if($date==0 and $hour==0 and $minute==0){
  return $second.'秒';}
if($date==0 and $hour==0){
  return $minute.'分';}
if($date==0){
  return $hour.'小时';}
if($second!=0 and $minute!=0){
  return $date.'天';}

}

function WriteTimeStamp($email,$itemname){
  //仅限user.php使用
  $tr=ReadDyn($email);
  $re_tr=array_reverse($tr);

  foreach ($re_tr as $key => $value) {
    $final=stristr($value,$itemname);
    if($final!=false){
      $stime=substr($value, 0,19);
      $ts=GetTimeStamp($stime);
      return $ts;
    }
    else{return false;}
  }
}

function DelTrendsItem($email,$num){
  //$num越大数据越新
  $tr=ReadDyn($email);
  $del_tr=array_splice($tr,$num,1);

  if($tr!=false){
    foreach ($del_tr as $key => $value) {
      $sql_up="UPDATE `acghub_member` SET `dynamic`='".$value."' WHERE `email`='".$email."'";
      $res_up=mysql_query($sql_up);
      if(mysql_affected_rows()!=-1){
        return true;
      }
      else{return false;}
    }
    
  }
  else{return false;}

}

/*****************************上传图片********************************/

function UploadPic($max_file_size=2000000,$destination_folder,$imgpreview=0,$imgpreviewsize=1,$formname){
  //上传文件类型列表
$uptypes=array(
    'image/jpg',
    'image/jpeg',
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'image/x-png'
);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!is_uploaded_file($_FILES[$formname][tmp_name])){
         //echo "图片不存在!";
         return -1;
         exit;
    }

    $file = $_FILES[$formname];
    if($max_file_size < $file["size"]){
        //echo "文件太大!";
        return -2;
        exit;
    }

    if(!in_array($file["type"], $uptypes)){
        //echo "文件类型不符!".$file["type"];
        return -3;
        exit;
    }

    if(!file_exists($destination_folder)){
        mkdir($destination_folder);
    }

    $filename=$file["tmp_name"];
    $image_size = getimagesize($filename);
    $pinfo=pathinfo($file["name"]);
    $ftype=$pinfo['extension'];
    $destination = $destination_folder.time().".".$ftype;//文件名
    if (file_exists($destination) && $overwrite != true){
        //echo "同名文件已经存在了";
        return -4;
        exit;
    }

    if(!move_uploaded_file ($filename, $destination)){
        //echo "移动文件出错";
        return -5;
        exit;
    }

    $pinfo=pathinfo($destination);
    $fname=$pinfo[basename];

    /*$final_data=array(
      "dest" => $destination_folder.$fname,
      "width" => $image_size[0],
      "height" => $image_size[1],
      );*/

    return $destination_folder.$fname;
    //echo " <font color=red>已经成功上传</font><br>文件名:  <font color=blue>".$destination_folder.$fname."</font><br>";
    //echo " 宽度:".$image_size[0];
    //echo " 长度:".$image_size[1];
    //echo "<br> 大小:".$file["size"]." bytes";


    if($imgpreview==1)
    {
    //echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
    }
}

}

/*****************************项目相关********************************/

function GetProType($dir){
  
  $ProType=array("script","storyboard","enactment","code","dubbing","music");

  $hand=fopen($dir, "r") or die("Unable to open file!");
  $rule=fread($hand,filesize($dir));
  fclose($hand);

  $ex_rule=explode("\r\n", $rule);
  $ex_rule_d=explode("=", $ex_rule[1]);

  switch ($ex_rule_d[1]) {
    case "script":
      return $ex_rule_d[1];
      break;
    case "storyboard":
      return $ex_rule_d[1];
      break;
    case "enactment":
      return $ex_rule_d[1];
      break;
    case "code":
      return $ex_rule_d[1];
      break;
     case "dubbing":
      return $ex_rule_d[1];
      break;
    case "music":
      return $ex_rule_d[1];
      break;                       
    default:
      return fasle;
      break;
  }

}

function GetDes($filename){
  if(file_exists($filename)){
    $opts = array('file' => array('encoding' => 'gb2312'));
    $ctxt = stream_context_create($opts);
    $contents=file_get_contents($filename, FILE_TEXT, $ctxt); 
    $contents = iconv("gb2312", "utf-8//IGNORE",$contents); 
    return $contents;
  }
  else{
    return false;
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

function GetAllItem($dir){
  $files=array();
  if($handle = opendir($dir)){
    while(($file = readdir($handle))!==false){
      if($file!=".." && $file!="."){
        if(is_dir($dir."/".$file) ){
          $files[$file]=scandir($dir."/".$file);
        }else{
          $files[]=iconv('gbk','utf-8',$file);
        }
      }
    }
  closedir($handle);
  return $files;
  }
}

function GetProNum($dir){
  $files = scandir($dir);
  if(file_exists("/prosetting.afg") and file_exists("/readme")){
    return count($files)-4;
  }
  else{
    return count($files)-2;
  }
}

function GetProEditor($uid){return GetName($uid);}

function GetProContent($dir){
    $filename = $dir;
    $handle = fopen($filename, "r");
    
    $contents = fread($handle, filesize ($filename));
    fclose($handle);

    return nl2br($contents);
}

/*****************************关注作品********************************/

function WriteForkWorks($uid,$name,$loginuid){
  //$uid->作品作者uid;$name->作品名;$loginuid->关注者uid
  $email=GetEmail($loginuid);

  $sql="SELECT `forkworks` FROM `acghub_member` WHERE `email`='$email'";
  $res=getone($sql);

  if($res!=false){
    if($res=="9"){
      $fw="{|%uid%=$uid|-&-|%name%=$name|}|+&+|";
    }
    else{
      $fw=$fw."{|%uid%=$uid|-&-|%name%=$name|}|+&+|";
    }
  }else{return false;}

  $sql="UPDATE `acghub_member` SET `forkworks`='$fw' WHERE `email`='".$email."'";
  $res=mysql_query($sql);
  if($res!=false){
    if(mysql_affected_rows()!=-1){
      return true;
    }else{return false;}
  }
  else{return false;}
}

function ReadForkWorks($loginuid){
  $email=GetEmail($loginuid);
  $sql="SELECT `forkworks` FROM `acghub_member` WHERE `email`='$email'";
  $res=getone($sql);
  if($res!=false){
    if($res=="9"){
      return -1;//无
    }else{
      $exworks=explode("|+&+|",$res);
      return $exworks;
    }
  }else{return false;}
}

function isFork($uid,$name,$loginuid){
  //$uid->项目作者uid
  $worksForked=ReadForkWorks($loginuid);
  if($worksForked!=false){
   if(is_array($worksForked)){
    foreach ($worksForked as $key => $value) {
      if(strlen($value)!=0){
        //%uid%=19|-&-|%name%=pu_sc
        $exbrace=substr($value, 2,strlen($value)-4);
        $exparameter=explode("|-&-|",$exbrace);

        $prouid=substr($exparameter[0], 6);
        $proname=substr($exparameter[1], 7);

        if($uid==$prouid and $name==$proname){
          return true;
        }
        else{
          return false;}
      }
    }
   } 
  }else{
    return false;}
}

function GetFollowerNum($uid,$itemname){
  //$uid->项目作者uid
  $count=0;

  $strSQL="SELECT `id` FROM `acghub_member`";
  $result=mysql_query($strSQL);
  while($row=mysql_fetch_row($result)){
   if(isFork($uid,$itemname,$row[0])){
    $count+=1;
   }
  }

  return $count;  
}

function GetFollower($uid,$itemname){
  //$uid->项目作者uid
  $index=0;
  $repo=array();

  $strSQL="SELECT `id` FROM `acghub_member`";
  $result=mysql_query($strSQL);
  while($row=mysql_fetch_row($result)){
      if(isFork($uid,$itemname,$row[0])){
        $repo[$index]=$row[0];
        $index+=1;
      }
  }

  return $repo;
}

function GetForkingWorksOfSomeoneSyn($method,$uid){
  //$method=1->Getuid $method=2->GetProname $uid->要得到关注作品的人
  $rfw=ReadForkWorks($uid);
  $pronamearr=array();

  if($rfw!=false){
    if($rfw==-1){
      return -1;//无
    }else{
      foreach ($rfw as $key => $value) {
        if(strlen($value)!=0){
          $exbrace=substr($value, 2,strlen($value)-4);$exparameter=explode("|-&-|",$exbrace);
          $prouid=substr($exparameter[0], 6);$proname=substr($exparameter[1], 7);
          switch ($method) {
            case 1:
              $pronamearr[$key]=$prouid;
              break;
            case 2:
              $pronamearr[$key]=$proname;
              break;
            default:
              return false;
              break;
          }
        }
      }
      return $pronamearr;
    }
  }else{return false;}
}

function GetForkedPronameByuid($uid){
  return GetForkingWorksOfSomeoneSyn(2,$uid);}

function GetForkeduidByuid($uid){
  return GetForkingWorksOfSomeoneSyn(1,$uid);}

function GetUidByItemname($itemname){

}

function isBelongTo($itemname){
  //判断itemname属于哪个uid

}

function itemIsExist($uid,$itemname){
  return file_exists("userpro/".$uid."/".$itemname);}

function uidIsExist($uid){
  if(GetEmail($uid)!=false){
    return true;
  }
  else{return false;}
}

function DelFork($uid,$name,$loginuid){

  $worksForked=ReadForkWorks($loginuid);

  if($worksForked!=false){
    foreach ($worksForked as $key => $value){
      if(strlen($value)!=0){
        //{|%uid%=19|-&-|%name%=pu_sc|}
        $exbrace=substr($value, 2,strlen($value)-4);$exparameter=explode("|-&-|",$exbrace);
        $prouid=substr($exparameter[0], 6);$proname=substr($exparameter[1], 7);

        if($uid==$prouid and $name==$proname){
          array_splice($worksForked,$key,1);
        }
        else{return false;}
      }
    }

    if(count($worksForked)==0){
      $sql_up="UPDATE `acghub_member` SET `forkworks`='9' WHERE `email`='".GetEmail($loginuid)."'";
      $res_up=mysql_query($sql_up);
      if(mysql_affected_rows()!=-1){
        return true;
      }
      else{return false;}      
    }
    else{
      foreach ($worksForked as $key => $value) {
        $sql_up="UPDATE `acghub_member` SET `forkworks`='".$value."' WHERE `email`='".GetEmail($loginuid)."'";
     
        $res_up=mysql_query($sql_up);
        if(mysql_affected_rows()!=-1){
          return true;
        }
        else{return false;}
       }
    }

  }
  else{return false;}

}
/**************************************评价作品*****************************************/

function LikeOrDislikeSyn($method,$email,$itemname,$uid){
  //$method=1->like $method=2->liker $method=3->dislike $method=4->disliker
  if($method==1){
    $sql="SELECT `like` FROM `acghub_member` WHERE `email`='$email'";
  }elseif ($method==2) {
    $sql="SELECT `liker` FROM `acghub_member` WHERE `email`='$email'";
  }elseif ($method==3) {
    $sql="SELECT `dislike` FROM `acghub_member` WHERE `email`='$email'";    
  }elseif ($method==4) {
    $sql="SELECT `disliker` FROM `acghub_member` WHERE `email`='$email'";
  }

  $res=getone($sql);

  if($res!=false){
    if($res=="9"){
      if($method==1){
        $wl="%like%=$itemname|--&&--|";
      }elseif ($method==2) {
        $wl="{|%likeruid%=$uid|-&&-|%itemname%=$itemname|}{|$&$|}";
      }elseif ($method==3) {
        $wl="%dislike%=$itemname|--&&--|";
      }elseif ($method==4) {
        $wl="{|%dislikeruid%=$uid|-&&-|%itemname%=$itemname|}{|$&$|}";
      }
    }
    else{
      if ($method==1) {
        $wl=$wl."%like%=$itemname|--&&--|";
      }elseif ($method==2) {
        $wl=$wl."{|%likeruid%=$uid|-&&-|%itemname%=$itemname|}{|$&$|}";
      }elseif ($method==3) {
        $wl=$wl."%dislike%=$itemname|--&&--|";
      }elseif ($method==4) {
        $wl=$wl."{|%dislikeruid%=$uid|-&&-|%itemname%=$itemname|}{|$&$|}";
      }
    }
  }else{return false;}

  if($method==1){
    $sql="UPDATE `acghub_member` SET `like`='$wl' WHERE `email`='".$email."'";
  }elseif ($method==2) {
    $sql="UPDATE `acghub_member` SET `liker`='$wl' WHERE `email`='".$email."'";
  }elseif ($method==3) {
    $sql="UPDATE `acghub_member` SET `dislike`='$wl' WHERE `email`='$email'";
  }elseif ($method==4) {
    $sql="UPDATE `acghub_member` SET `disliker`='$wl' WHERE `email`='$email'";
  }
  
  $res=mysql_query($sql);

  if($res!=false){
    if(mysql_affected_rows()!=-1){
      return true;
    }else{return false;}
  }else{return false;}

}

/*******************************************************/

function WriteLike($itemname,$email){
  return LikeOrDislikeSyn(1,$email,$itemname,0);}

function WriteLiker($uid,$itemname,$email){
  return LikeOrDislikeSyn(2,$email,$itemname,$uid);}

function WriteDislike($itemname,$email){
  return LikeOrDislikeSyn(3,$email,$itemname,0);}

function WriteDisliker($uid,$itemname,$email){
  return LikeOrDislikeSyn(4,$email,$itemname,$uid);}

/*******************************************************/

function ReadLikeOrLikerSyn($method,$uid){
  //$method=1->like $method=2->liker $method=3->dislike $method=4->disliker
  if($method==1){
    $sql="SELECT `like` FROM `acghub_member` WHERE `id`=$uid";
  }elseif ($method==2) {
    $sql="SELECT `liker` FROM `acghub_member` WHERE `id`=$uid";
  }elseif ($method==3) {
    $sql="SELECT `dislike` FROM `acghub_member` WHERE `id`=$uid";
  }elseif ($method==4) {
    $sql="SELECT `disliker` FROM `acghub_member` WHERE `id`=$uid";
  }
  
  $res=getone($sql);
  if($res!=false){
    if($method==1 or $method==3){
      //%like%=pu_sc|--&&--|
      $like=explode("|--&&--|",$res);
      $sublike_arr=array();
      foreach ($like as $key => $value) {
        if(strlen($value)!=0){
          if($method==1){
            $sublike=substr($value, 7);
          }elseif ($method==3) {
            $sublike=substr($value, 10);
          }
          $sublike_arr[$key]=$sublike;
        }
      }
      return $sublike_arr;
    }
    elseif ($method==2 or $method==4) {
      // {|%likeruid%=19|-&&-|%itemname%=dyntest2|}{|$&$|}
      $liker=explode("{|$&$|}", $res);
      $subliker_arr=array();
      foreach ($liker as $key => $value) {
        if(strlen($value)!=0){
          //$subliker=str_replace("{|%likeruid%=","",$value);
          if($method==2){
            $subliker=substr($value,15);
          }elseif ($method==4) {
            $subliker=substr($value,18);
          }
          $subliker=str_replace("%itemname%=","",$subliker);
          $subliker=str_replace("|}","",$subliker);

          $subliker_arr[$key]=$subliker;
        }
      }
      return $subliker_arr;
    }
  }
  else{return false;}
}

function ReadLike($uid){
  return ReadLikeOrLikerSyn(1,$uid);}

function ReadLiker($uid){
  return ReadLikeOrLikerSyn(2,$uid);}

function ReadDislike($uid){
  return ReadLikeOrLikerSyn(3,$uid);}

function ReadDisliker($uid){
  return ReadLikeOrLikerSyn(4,$uid);}

function isLikeSyn($method,$uid,$itemname){
  //$method=1->like $method=2->dislike
  //$uid->要判断的人 $itemname->要判断的项目名
  if($method==1){
    $rl=Readlike($uid);
  }elseif ($method==2) {
    $rl=ReadDislike($uid);
  }
  
  if($rl!=false){
    foreach ($rl as $key => $value) {
      if($itemname==$value){
        return true;
        break;
      }
      else{return false;}
    }
  }else{return false;}
}

function isLike($uid,$itemname){
  return isLikeSyn(1,$uid,$itemname);
}

function isDislike($uid ,$itemname){
  return isLikeSyn(2,$uid,$itemname);
}

function GetLikerOrDislikerNumSyn($method,$itemname){
  //$method=1->like //$method=2->dislike
  $count=0;

  $strSQL="SELECT `id` FROM `acghub_member`";
  $result=mysql_query($strSQL);
  while($row=mysql_fetch_row($result)){
    switch ($method) {
      case 1:
        if(isLike($row[0],$itemname)){
          $count+=1;}
        break;
      case 2:
        if(isDislike($row[0],$itemname)){
          $count+=1;}
        break;
    }
  }

  return $count;
}

function GetLikerNum($itemname){
  return GetLikerOrDislikerNumSyn(1,$itemname);}

function GetDislikerNum($itemname){
  return GetLikerOrDislikerNumSyn(2,$itemname);}  

function GetLikerOrDislikerSyn($method,$itemname){
  //$method=1->like //$method=2->dislike
  $index=0;
  $repo=array();

  $strSQL="SELECT `id` FROM `acghub_member`";
  $result=mysql_query($strSQL);
  while($row=mysql_fetch_row($result)){
    switch ($method) {
      case 1:
        if(isLiker($row[0],$itemname)!=false){
          $repo[$index]=$row[0];
          $index+=1;
        }
        break;
      case 2:
        if(isDisliker($row[0],$itemname)!=false){
          $repo[$index]=$row[0];
          $index+=1;
        }
        break;
    }
  }

  return $repo;
}

function GetLiker($itemname){
  return GetLikerOrDislikerSyn(1,$itemname);}

function GetDisliker($itemname){
  return GetLikerOrDislikerSyn(2,$itemname);}

function isLiker($uid,$itemname){
  if(isLike($uid,$itemname)){
    return $uid;
  }else{return false;}
}

function isDisliker($uid,$itemname){
  if(isDislike($uid,$itemname)){
    return $uid;
  }else{return false;}
}

function DelLikeOrDislikeSyn($method,$itemname,$uid,$uidA){
  //$uid->取赞的人 $itemname->被取赞的项目 $uidA->项目作者
  //$method=1->like $method=2->dislike
  $flag0=0;

  $rl=ReadLike($uid);
  if($rl!=false){
    foreach ($rl as $key => $value) {
      if($value==$itemname){
        if(count($rl)==1){
          $rldel=array_splice($rl,0,1);
          break;
        }else{
          $rldel=array_splice($rl,$key,1);
        }
      }
    }
  }
  else{$flag0=0;}

  $flag1=0;

  if(count($rlel)==0){

    switch ($method) {
      case 1:
        $sql="UPDATE `acghub_member` SET `like`='9' WHERE `id`=".$uid;
        break;
      case 2:
        $sql="UPDATE `acghub_member` SET `dislike`='9' WHERE `id`=".$uid;
        break;
      default:
        return false;
        break;
    }

    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        $flag1=1;
      }
    }else{$flag0=0;}
  }
  else{

  foreach ($rldel as $key => $value) {
    
    if(strlen($value)==0){
      $v="9";
    }else{
      switch ($method) {
        case 1:
          $v="%like%=$value|--&&--|";
          break;
        case 2:
          $v="%dislike%=$value|--&&--|";
          break;
        default:
          return false;
          break;
      }
    }

    switch ($method) {
      case 1:
        $sql="UPDATE `acghub_member` SET `like`='$v' WHERE `id`=".$uid;
        break;
      case 2:
        $sql="UPDATE `acghub_member` SET `dislike`='$v' WHERE `id`=".$uid;
        break;
      default:
        return false;
        break;
    }
    
    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        $flag1=1;
        if(strlen($value)==0){break;}
      }
      else{
        $flag0=0;
      }
    }else{$flag0=0;}

  }    

  }

  /************************************************/

  $rler=ReadLiker($uidA);
  //Array ( [0] => |-&&-|pu_sc )
  if($rler!=false){
    foreach ($rler as $key => $value) {
      $rler_ex=explode("|-&&-|", $value);
      if($uid==$rler_ex[0] and $itemname==$rler_ex[1]){
        if(count($rler)==1){
          unset($rler);
          $rlerdel=array_splice($rler,0,1);
        }else{
          $rlerdel=array_splice($rler,$key,1);
        }
      }
      else {
        $flag0=0;
      }
    }
  }else{$flag0=0;}

  $flag2=0;
  if(count($rlerdel)==0){

    switch ($method) {
      case 1:
        $sql="UPDATE `acghub_member` SET `liker`='9' WHERE `id`=".$uidA;
        break;
      case 2:
        $sql="UPDATE `acghub_member` SET `disliker`='9' WHERE `id`=".$uidA;
        break;
      default:
        return false;
        break;
    }

    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        $flag1=1;
      }
    }else{$flag0=0;}
  }
  else{

  foreach ($rlerdel as $key => $value) {
    $rler_ex=explode("|-&&-|", $value);
    if(strlen($rler_ex[0])==0 or strlen($rler_ex[1])==0){
      $vdata="9";
    }
    else{
      $vdata="{|%dislikeruid%=$rler_ex[0]|-&&-|%itemname%=$rler_ex[1]|}{|$&$|}";
    }
    
    switch ($method) {
      case 1:
        $sql="UPDATE `acghub_member` SET `liker`='".$vdata."' WHERE `id`=".$uidA;
        break;
      case 2:
        $sql="UPDATE `acghub_member` SET `disliker`='".$vdata."' WHERE `id`=".$uidA;
        break;
      default:
        return false;
        break;
    }
    
    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        $flag2=1;
        if(strlen($rler_ex[0])==0 or strlen($rler_ex[1])==0){break;}
      }else{$flag0=0;}
    }else{$flag0=0;}    
  }    

  }

  if($flag1==1 and $flag2==1){
    return true;
  }else{return false;}

}

function DelLike($itemname,$uid,$uidA){
  DelLikeOrDislikeSyn(1,$itemname,$uid,$uidA);}

function DelDislike($itemname,$uid,$uidA){
  DelLikeOrDislikeSyn(2,$itemname,$uid,$uidA);}

/************************LIKE***********************/

/*******************推荐作品上首页*********************/

/**
* 
*/
class RecommendWorks{
  var $itemuid=array();
  var $itemname=array();
  var $itemmarks=array();
  var $itemnum=array();
  var $itemeditor=array();
  var $itemdes=array();
  var $itemwholemarks=array();
  var $itemtime=array();

  var $type;

  var $newitemuid=array();
  var $newitemname=array();
  var $newitemnum=array();
  var $newitemeditor=array();
  var $newitemmarks=array();
  var $newitemdes=array();
  var $newitemtime=array();

  function __construct($initype){
  //$typ=1->脚本 $type=2->分镜 $type=3->设定 $type=4->代码 $type=5->配音 $type=6->音乐
  //array("script","storyboard","enactment","code","dubbing","music");
    switch ($initype) {
      case 1:
        $this->type="script";
        break;
      case 2:
        $this->type="storyboard";
        break;
      case 3:
        $this->type="enactment";
        break;
      case 4:
        $this->type="code";  
        break;
      case 5:
        $this->type="dubbing";
        break;
      case 6:
        $this->type="music";
        break;    
      default:
        $this->type="all";
        break;
    }
    $allid=GetAllId();
    $count=0;

    foreach ($allid as $key => $id) {
      $itemarr=GetItem("userpro/".$id);
      $a=count($itemarr);
      for($i=2;$i<=$a-1;$i++){
        $gln=GetLikerNum($itemarr[$i]); 
        $gfn=GetFollowerNum($id,$itemarr[$i]);

        $this->itemuid[$count]=$id;
        $this->itemname[$count]=$itemarr[$i];
        $this->itemnum[$count]=GetProNum("userpro/".$id."/".$itemarr[$i]);
        $this->itemeditor[$count]=GetProEditor($id);
        $this->itemmarks[$count]=round($gfn*0.4+$gln*0.6,2);
        $this->itemdes[$count]=GetDes("userpro/".$id."/".$itemarr[$i]."/readme");
        $this->itemwholemarks[$count]=round($gfn*0.4+$gln*0.6,2);
        $this->itemtime[$count]=filectime("userpro/".$id."/".$itemarr[$i]);

        $count+=1;
      }
    }
    arsort($this->itemwholemarks);
    arsort($this->itemtime);
  }

  function InitializeRecommendedItem(){
    $count=0;
    foreach ($this->itemuid as $key => $id) {
      if(GetProType("userpro/".$id."/".$this->itemname[$key]."/prosetting.afg")==$this->type){
        $this->newitemuid[$count]=$id;
        $this->newitemname[$count]=$this->itemname[$key];
        $this->newitemnum[$count]=$this->itemnum[$key];
        $this->newitemeditor[$count]=$this->itemeditor[$key];
        $this->newitemmarks[$count]=$this->itemmarks[$key];
        $this->newitemdes[$count]=$this->itemdes[$key];
        $this->newitemtime[$count]=$this->itemtime[$key];

        $count+=1;
      }
    }

    arsort($this->newitemmarks);
  }

}

?>