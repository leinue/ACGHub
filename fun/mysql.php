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
    if($this->type!=1){
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
      return $row[0];
    }
  }else{return false;}
  }

  function GetFollowedAmount($uid){
    return SynGetFollowedOrFollowingAmount(1,$uid);}

  function GetFollowingAmount($uid){
    return SynGetFollowedOrFollowingAmount(2,$uid);}

  function SynWriteFollowedOrFollowingAmount($method,$uid){
    //method=1->followed method=2->following
    if($this->type!=1){
    switch ($method) {
      case 1:
        $current_quantity=$this->GetFollowedAmount($uid);
        $foed_added_quantity=$current_quantity+1;
        $foing_added_quantity=$this->GetFollowingAmount($uid);
        break;
      case 2:
        $current_quantity=$this->GetFollowingAmount($uid);
        $foing_added_quantity=$current_quantity+1;
        $foed_added_quantit=$this->GetFollowedAmount($uid);
        break;
      default:
        return false;
        break;
    }

    $sql="INSERT INTO `acghub_fork_info`(
          `uid`, `FollowingNum`, `FollowedNum`) VALUES
         ($uid,$foed_added_quantity,$foing_added_quantity)";
    
    $res=mysql_query($sql);
    if($res!=false){
      if(mysql_affected_rows()!=-1){
        return true;
      }
    }else{return false;}
  }else{return false;}
  }

  function WriteFollowedAmount($uid){
    return SynWriteFollowedOrFollowingAmount(1,$uid);}

  function WriteFollowingAmount($uid){
    return SynWriteFollowedOrFollowingAmount(2,$uid);}

/*************************************************************/

  function SynGetFollowingOrFollowed($method,$uid){
    //method=1->followed method=2->following
    $count=0;
    switch ($mthod) {
      case 1:
        $sql="SELECT `followed` FROM `acghub_fork_followed` WHERE `uid`=$uid";
        $sql_time="SELECT `fotime` FROM `acghub_fork_followed` WHERE `uid`=$uid";
        break;
      case 2:
        $sql="SELECT `following` FROM `acghub_fork_following` WHERE `uid`=$uid";
        $sql_time="SELECT `fotime` FROM `acghub_fork_following` WHERE `uid`=$uid";
        break;
      default:
        return false;
        break;
    }
    
    $res=mysql_query($sql);
    if($res!=false){
      $row=mysql_fetch_row($res);
      while ($row) {
        switch ($method) {
          case 1:
            $this->UidOfFollowed[$count]=$row[0];
            break;
          case 2:
            $this->UidOfFollowing[$count]=$row[0];
            break;
          default:
            return false;
            break;
        }
        $count=$count+1;
      }
    }else{return false;}

    $res_time=mysql_query($sql){
      if($res!=false){
      $row=mysql_fetch_row($res);
      while ($row) {
        switch ($method) {
          case 1:
            $this->$TimeOfFollowed[$count]=$row[0];
            break;
          case 2:
            $this->$TimeOfFollowing[$count]=$row[0];
            break;
          default:
            return false;
            break;
        }
        $count=$count+1;
      }
    }else{return false;}
    }
  }

  function GetFollowing($uid){
    return SynGetFollowingOrFollowed(2,$uid);}

  function GetFollowed($uid){
    return SynGetFollowingOrFollowed(1,$uid);}


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
    return SynWriteFollowingOrFollowed(2,$uid_foing,$uid_foed);}

  function WriteFollowed($uid_foing,$uid_foed){
    return SynWriteFollowingOrFollowed(1,$uid_foing,$uid_foed);}

  function isFollowing($uid,$uidChecked){
    GetFollowing($uid);
    foreach ($this->UidOfFollowing as $key => $value) {
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
    GetFollowed($uid);
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
    return (isFollowing($uid1,$uid2) and isFollowed($uid1,$uid2));}

  function SynCancelFollowingOrFollowed($method,$uid,$uidCanceled){
    switch ($method) {
      case 1:
        $sql="DELETE FROM `acghub_fork_followed` WHERE `followed`=$uidCanceled and `uid`=$uid";
        break;
      case 2:
        $sql="DELETE FROM `acghub_fork_following` WHERE `following`=$uidCanceled and `uid`=$uid";
        break;
      default:
        return false;
        break;
    }
  }

  function CancelFollowing($uid,$uidCanceled){
    return SynCancelFollowingOrFollowed(2,$uid,$uidCanceled);}

  function CancelFollowed($uid,$uidCanceled){
    return SynCancelFollowingOrFollowed(1,$uid,$uidCanceled);}

  function __destruct(){
    mysql_close($this->con);
  }
}

?>