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
  	name varchar(10) NOT NULL,
  	email varchar(100) NOT NULL,
  	password varchar(16) NOT NULL,
  	_date varchar(100) NOT NULL,
  	sta varchar(5) NOT NULL,
  	checked int(1) NOT NULL,
  	PRIMARY KEY (id)
  	)";

  if(mysql_query($sql)){
  	die('safsafasfas'.mysql_error());
  }
  else {die();}
}

?>