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
  
  function __construct(){
    $this->con = mysql_connect("localhost","root","xieyang");
    if(!$this->con){
      die('Could not connect: ' . mysql_error());
    }

    $db_selected=mysql_select_db("acghub_fork_info", $this->con);
    if (!$db_selected){
      $this->result=false;
    }else{$this->result=true;}
  }

  function SynGetFollowedOrFollowingAmount($method,$uid){
    //method=1->followed method=2->following
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
  }

  function GetFollowedAmount($uid){
    return SynGetFollowedOrFollowingAmount(1,$uid);}

  function GetFollowingAmount($uid){
    return SynGetFollowedOrFollowingAmount(2,$uid);}

  function SynWriteFollowedOrFollowingAmount($method,$uid){
    switch ($method) {
      case 1:
        $current_quantity=$this->GetFollowedAmount($uid);
        $added_quantity=$current_quantity+1;
        $sql="UPDATE `acghub_fork_info` SET `FollowedNum`=$added_quantity WHERE `uid=`$uid";
        break;
      case 2:
        $current_quantity=$this->GetFollowingAmount($uid);
        $added_quantity=$current_quantity+1;
        $sql="UPDATE `acghub_fork_info` SET `FollowingNum`=$added_quantity WHERE `uid=`$uid";
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
  }

  function WriteFollowedAmount($uid){
    return SynWriteFollowedOrFollowingAmount(1,$uid);}

  function WriteFollowingAmount($uid){
    return SynWriteFollowedOrFollowingAmount(2,$uid);}

  function __destruct(){
    mysql_close($this->con);
  }
}

?>