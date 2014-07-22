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
  $sql="SELECT `photo` FROM `acghub_member` WHERE `email`='$email'";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetEmail($uid){
  $sql="SELECT `email` FROM `acghub_member` WHERE `id`=$uid";
  $res=getone($sql);
  if($res!=false){
    return $res;
  }else{return false;}
}

function GetName($uid){
  $sql="SELECT `name` FROM `acghub_member` WHERE `id`=$uid";
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


?>