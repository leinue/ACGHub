<?php

function connect_mysql(){
  if($sign_id=mysql_connect("localhost","root","xieyang")){
    if($db=mysql_select_db("club")){
      return true;
    }
    else{
      if(mysql_query("CREATE DATABASE club")){
        return true;
      }
      else{
      	die();
      	return false;
      }
    }
    }
    else{
    	die();
    	return false;
    }
}

function create_table(){
  $sql="CREATE TABLE acghub_member(
  	id int(11) NOT NULL AUTO_INCREMENT,
  	`name` varchar(10) NOT NULL,
  	`email` varchar(100) NOT NULL,
  	`password` varchar(16) NOT NULL,
  	`_date` varchar(100) NOT NULL,
  	`sta` varchar(5) NOT NULL,
  	checked int(1) NOT NULL,
    sex int(1) NOT NULL,
    `website` varchar(100) NOT NULL,
    age int(3) NOT NULL,
    `location` varchar(100) NOT NULL,
    `message` TEXT NOT NULL,
    `friends` TEXT NOT NULL,
    `photo` TEXT NOT NULL,
    `dynamic` TEXT NOT NULL,
    `forworks` TEXT NOT NULL,
    `like` TEXT NOT NULL,
    `liker` TEXT NOT NULL,
    `dislike` TEXT NOT NULL,
    `disliker` TEXT NOT NULL,
  	PRIMARY KEY (id)
  	)";

  if(mysql_query($sql)){
  	die(mysql_error());
  }
  else {die();}
}

function Create_Setting_Table(){
  $sql="CREATE TABLE acghub_admin_setting(
    id int(11) NOT NULL AUTO_INCREMENT,
    title TEXT NOT NULL,
    subhead TEXT NOT NULL,
    description TEXT NOT NULL,
    keywords TEXT NOT NULL,
    PRIMARY KEY (id)
    )";
  $res=mysql_query($sql);
  if($res!=false){
    mysql_select_db("acghub_admin_setting");
    $sql="INSERT INTO `acghub_admin_setting`(`title`, `subhead`, `description`, `keywords`) VALUES 
    ('ACGHub','更好的分享创意','ACGHub,为所有ACG创造者而生','ACG,动漫,脚本,分镜')";
    $res_in=mysql_query($sql);
    if($res_in!=false){
      if(mysql_affected_rows()!=-1){
        return true;
      }else{return false;}
    }else{return false;}
  }else{
    return false;
  }
}

function CreateMSGTable(){
  $sql="CREATE TABLE acghub_msg(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `_from` int(11) NOT NULL,
    `_to` int(11) NOT NULL,
    `content` TEXT NOT NULL,
    `datetime` TEXT NOT NULL,
    `isread` int(11) NOT NULL,
    PRIMARY KEY (id)
    )DEFAULT CHARSET=utf8;";
  $res=mysql_query($sql);
  if($res!=false){
    return true;
  }else{return false;}
}

/**
* concerning fork
*/
class DBConcerningForking{
  var $result;
  var $con;
  var $type;

  var $UidOfFollowing=array();
  var $TimeOfFollowing=array();
  var $UidOfFollowed=array();
  var $TimeOfFollowed=array();
  
  function __construct($method){
    //method=1->人数相关 method=2->关注相关 method=3->粉丝相关
    $this->con = mysql_connect("localhost","root","xieyang");
    if(!$this->con){
      die('Could not connect: ' . mysql_error());
    }

    switch ($method) {
      case 1:
        $db_name="acghub_fork_info";
        $this->type=$method;
        break;
      case 2:
        $db_name="acghub_fork_following";
        $this->type=$method;
        break;
      case 3:
        $db_name="acghub_fork_followed";
        $this->type=$method;
        break;
      default:
        return false;
        break;
    }

    $db_selected=mysql_select_db($db_name, $this->con);
    if (!$db_selected){
      $this->result=false;
    }else{$this->result=true;}
  }

/*************************************************************/

  function SynGetFollowedOrFollowingAmount($method,$uid){
    //method=1->followed method=2->following
    if($this->type==1){
    switch ($method) {
      case 1:
        $sql="SELECT `FollowedNum` FROM `acghub_fork_info` WHERE `uid`=$uid";
        break;
      case 2:
        $sql="SELECT `FollowingNum` FROM `acghub_fork_info` WHERE `uid`=$uid";
        break;
      default:
        return false;
        break;
    }
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      if(strlen($row[0])!=0){
        return $row[0];
      }else{
        return 0;
      }
      
    }
  }else{return false;}
  }

  function GetFollowedAmount($uid){
    return $this->SynGetFollowedOrFollowingAmount(1,$uid);}

  function GetFollowingAmount($uid){
    return $this->SynGetFollowedOrFollowingAmount(2,$uid);}

  function SynWriteFollowedOrFollowingAmount($method,$uid){
    //method=1->followed method=2->following
    if($this->type==1){
    switch ($method) {
      case 1:
        $current_quantity=$this->GetFollowedAmount($uid);
        $foed_added_quantity=$current_quantity+1;
        $sql="UPDATE `acghub_fork_info` SET `FollowedNum`=$foed_added_quantity WHERE `uid`=$uid";
        break;
      case 2:
        $current_quantity=$this->GetFollowingAmount($uid);
        $foing_added_quantity=$current_quantity+1;
        $sql="UPDATE `acghub_fork_info` SET `FollowingNum`=$foing_added_quantity WHERE `uid`=$uid";
        break;
      default:
        return false;
        break;
    }
    
    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        return true;
      }
    }else{return false;}
  }else{return false;}
  }

  function WriteFollowedAmount($uid){
    return $this->SynWriteFollowedOrFollowingAmount(1,$uid);}

  function WriteFollowingAmount($uid){
    return $this->SynWriteFollowedOrFollowingAmount(2,$uid);}

/*************************************************************/

  function SynGetFollowingOrFollowed($method,$uid){
    //method=1->followed method=2->following
    
    switch ($method) {
      case 1:
        $sql="SELECT `Followed` FROM `acghub_fork_followed` WHERE `uid`=$uid";
        $sql_time="SELECT `Fotime` FROM `acghub_fork_followed` WHERE `uid`='$uid'";
        break;
      case 2:
        $sql="SELECT `Following` FROM `acghub_fork_following` WHERE `uid`=$uid";
        $sql_time="SELECT `Fotime` FROM `acghub_fork_following` WHERE `uid`='$uid'";
        break;
      default:
        return false;
        break;
    }
    
    $cnt=0;

    $res=mysql_query($sql);
    if($res!=false){
      while ($row=mysql_fetch_row($res)) {
        switch ($method){
          case 1:
            $this->UidOfFollowed[$cnt]=$row[0];
            break;
          case 2:
            $this->UidOfFollowing[$cnt]=$row[0];
            break;
          default:
            return false;
            break;
        }
        $cnt=$cnt+1;
      }
    }else{return false;}

    $count=0;

    $res=mysql_query($sql_time);
      if($res!=false){
      while ($row=mysql_fetch_row($res)) {
        switch ($method) {
          case 1:
            $this->TimeOfFollowed[$count]=$row[0];
            break;
          case 2:
            $this->TimeOfFollowing[$count]=$row[0];
            break;
          default:
            return false;
            break;
        }
        $count=$count+1;
      }
    }else{return false;}
    
  }

  function GetFollowing($uid){
    return $this->SynGetFollowingOrFollowed(2,$uid);}

  function GetFollowed($uid){
    return $this->SynGetFollowingOrFollowed(1,$uid);}


  function SynWriteFollowingOrFollowed($method,$uid_foing,$uid_foed){
    //method=1->followed method=2->following
    date_default_timezone_set('Etc/GMT-8');//设置时区
    $enddate=date("Y-m-d H:i:s");

    switch ($method) {
      case 1:
        $sql="INSERT INTO `acghub_fork_followed`(
          `uid`, `Followed`, `Fotime`) VALUES
         ($uid_foing,$uid_foed,'$enddate')";
        break;
      case 2:
        $sql="INSERT INTO `acghub_fork_following`(
          `uid`, `Following`, `Fotime`) VALUES
         ($uid_foing,$uid_foed,'$enddate')";
        break;
      default:
        return false;
        break;
    }

    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        return true;
      }else{return false;}
    }else{return false;}
  }

  function WriteFollowing($uid_foing,$uid_foed){
    return $this->SynWriteFollowingOrFollowed(2,$uid_foing,$uid_foed);}

  function WriteFollowed($uid_foing,$uid_foed){
    return $this->SynWriteFollowingOrFollowed(1,$uid_foing,$uid_foed);}

  function isFollowing($uid,$uidChecked){
    $this->GetFollowing($uid);
    foreach ($this->UidOfFollowing as $key => $value){
      if($value==$uidChecked){
        return true;
        break;
      }else{
        return false;
        break;
      }
    }
  }

  function isFollowed($uid,$uidChecked){
    $this->GetFollowed($uid);
    foreach ($this->UidOfFollowed as $key => $value) {
      if($value==$uidChecked){
        return true;
        break;
      }else{
        return false;
        break;
      }
    }    
  }

  function isFollowedByEachOther($uid1,$uid2){
    return ($this->isFollowing($uid1,$uid2) and $this->isFollowed($uid1,$uid2));}

  function SynCancelFollowingOrFollowed($method,$uid,$uidCanceled){
    switch ($method){
      case 1:
        $sql="DELETE FROM `acghub_fork_followed` WHERE `followed`=$uid and `uid`=$uidCanceled";
        break;
      case 2:
        $sql="DELETE FROM `acghub_fork_following` WHERE `following`=$uidCanceled and `uid`=$uid";
        break;
      default:
        return false;
        break;
    }

    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        switch($method){
          case 1:
            $curq=$this->GetFollowedAmount($uidCanceled);
            $curq=$curq-1;
            $sql="UPDATE `acghub_fork_info` SET `FollowedNum`=$curq WHERE `uid`=$uidCanceled";
            break;
          case 2:
            $curq=$this->GetFollowingAmount($uid);
            $curq=$curq-1;
            $sql="UPDATE `acghub_fork_info` SET `FollowingNum`=$curq WHERE `uid`=$uid";
            break;
          default:
            return false;
            break;
        }

        $res=mysql_query($sql);
        if($res!=false){
          if(mysql_affected_rows()!=-1){
              return true;
          }else{return false;}
        }else{return false;}
      }else{return false;}
    }else{return false;}
  }

  function CancelFollowing($uid,$uidCanceled){
    return $this->SynCancelFollowingOrFollowed(2,$uid,$uidCanceled);}

  function CancelFollowed($uid,$uidCanceled){
    return $this->SynCancelFollowingOrFollowed(1,$uid,$uidCanceled);}

  function CancelFo($uid,$uidCanceled){
    return ($this->CancelFollowing($uid,$uidCanceled) and $this->CancelFollowed($uid,$uidCanceled));}
  //function __destruct(){mysql_close($this->con);}
}

?>