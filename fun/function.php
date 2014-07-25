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
  $sql="SELECT `id` FROM `acghub_member` WHERE `email`='$email'";
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
  
  $ProType = array("script","Storyboard","enactment","code","dubbing","music");

  $hand=fopen($dir, "r") or die("Unable to open file!");
  $rule=fread($myfile,filesize($dir));
  fclose($hand);

  $ex_rule=explode("\r\n", $rule);

  foreach ($ProType as $key => $value) {
    if($ex_rule==$value){
      return $value;
    }
  }

}

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
    $exworks=explode("|+&+|",$res);
    return $exworks;
  }else{return false;}
}

function isFork($uid,$name,$loginuid){
  $worksForked=ReadForkWorks($loginuid);
  if($worksForked!=false){
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
  }else{
    return false;}
}

function DelFork($uid,$name,$loginuid){

  $worksForked=ReadForkWorks($loginuid);
  if($worksForked!=false){
    foreach ($worksForked as $key => $value){

      $exbrace=substr($value, 2,strlen($value)-4);$exparameter=explode("|-&-|",$exbrace);
      $prouid=substr($exparameter[0], 6);$proname=substr($exparameter[1], 7);

      if($uid==$prouid and $name==$proname){
          $wfdel=array_splice($value,$key,1);
      }
      else{return false;}
    }

    foreach ($wfdel as $key => $value) {
      $sql_up="UPDATE `acghub_member` SET `forkworks`='".$value."' WHERE `email`='".GetEmail($loginuid)."'";
      $res_up=mysql_query($sql_up);
      if(mysql_affected_rows()!=-1){
        return true;
      }
      else{return false;}
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
  }elseif ($metho==4) {
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
    $sql="UPDATE ``acghub_member SET `disliker`='$wl' WHERE `email`='$email'";
  }
  
  $res=mysql_query($sql);

  if($res!=false){
    if(mysql_affected_rows()!=-1){
      return true;
    }else{return false;}
  }else{return false;}

}

function WriteLike($itemname,$email){
  return LikeOrDislikeSyn(1,$email,$itemname,0);}

function WriteLiker($uid,$itemname,$email){
  return LikeOrDislikeSyn(2,$email,$itemname,$uid);}

function WriteDislike($itemname,$email){
  return LikeOrDislikeSyn(3,$email,$itemname,0);}

function WriteDisliker($uid,$itemname,$email){
  return LikeOrDislikeSyn(4,$email,$itemname,$uid);}

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
            $subliker=substr($value,16);
          }elseif ($method==4) {
            $subliker=substr($value,19);
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

/*function isLiker($uid,$itemname){
  //$uid->要判断的人 $itemname->要判断的项目名
  $rler=ReadLiker($uid);
  if($rler!=false){
    foreach ($rler as $key => $value) {
      echo $value;
      $rler_ex=explode("|-&&-|", $value);
      if($itemname==$rler_ex[1]){
        $rler_uid_ex=explode(",", $rler_ex[0]);
        foreach ($rler_uid_ex as $i => $data) {
          if(strlen($data)!=0){
            if($uid==$data){
              return true;
            }
            else{
              return false;}
          }
        }
      }else{
        return false;}
    }
  }else{
    return false;}
}*/

function GetLikerNum($itemname){
  $count=0;

  $sql="SELECT `id` FROM `acghub_member` WHERE ";
  $res=getone($sql);
  if($res!=false){
    if(isLike($res,$itemname)){
      $count+=1;
    }
  }else{return false;}
}

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

function DelLike($itemname,$uid,$uidA){
  //$uid->取赞的人 $itemname->被取赞的项目 $uidA->项目作者
  $flag0=0;

  $rl=ReadLike($uid);
  if($rl!=false){
    foreach ($rl as $key => $value) {
      if($value==$itemname){
        if(count($rl)==1){
          unset($rl);
          break;
        }else{
          $rldel=array_splice($rl,$key,1);
        }
      }
    }
  }
  else{$flag0=0;}

  $flag1=0;

  if(count($rl)==0){
    $sql="UPDATE `acghub_member` SET `like`='9' WHERE `id`=".$uid;
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
      $v="%like%=$value|--&&--|";
    }

    $sql="UPDATE `acghub_member` SET `like`='".$v."' WHERE `id`=".$uid;
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
  print_r($rler);
  if($rler!=false){
    foreach ($rler as $key => $value) {
      $rler_ex=explode("|-&&-|", $value);
      if($uid==$rler_ex[0] and $itemname==$rler_ex[1]){
        if(count($rler)==1){
          unset($rler);
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
  if(count($rler)==0){
    $sql="UPDATE `acghub_member` SET `liker`='9' WHERE `id`=".$uidA;
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
    
    $sql="UPDATE `acghub_member` SET `liker`='".$vdata."' WHERE `id`=".$uidA;
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

/**********************DISLIKE*********************/

?>