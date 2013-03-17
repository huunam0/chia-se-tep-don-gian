<?php

/*
===============================================================================
=     Php Open FileSharing
=
=     Copyright (c) 2007-2008 Vasiliy Altunin
=     http://phpofs.sf.net
=     skyr@users.sourceforge.net
=
=     Released under the terms and conditions of the
=     GNU General Public License (http://gnu.org).
=
===============================================================================
*/

class MySQLDB
{ 
	
  var $DbHost;
  var $DbName; 
  var $DbuName; 
  var $DbuPass;
  var $Sql_Connection;
  var $Result;
  
  function connect($dbhost, $dbname, $dbuname, $dbupass)
  {
    $this->Sql_Connection = mysql_connect($dbhost, $dbuname, $dbupass) 
      or die("Could not connect: " . mysql_error());;  
    
    mysql_select_db($dbname, $this->Sql_Connection);
    mysql_query("SET NAMES 'utf8'",$this->Sql_Connection);
    //mysql_query("set global date_format='%d.%m.%Y'"); 
  }
  
  function Query($querytxt)
  { 
    return mysql_query($querytxt, $this->Sql_Connection);
  } 	
  
  function Fetch($res)
  { 
    return mysql_fetch_array($res);	
  } 	
  
  function Close()
  {
    mysql_close($this->Sql_Connection);
  }
  
  function Insert($table,$fields,$data)
  {
    //echo "<p>insert into $table ($fields) values ($data)<p>";
    return mysql_query("insert into $table ($fields) values ($data)", 
      $this->Sql_Connection);
  }
  
  function Delete($table,$qry)
  {
    //echo $qry;
    return mysql_query("delete from $table where $qry", 
      $this->Sql_Connection);
  }

  function Modify($table,$data,$qry)
  {
    //echo "<p>update $table set $data where $qry<p>";
    return mysql_query("update $table set $data where $qry", 
      $this->Sql_Connection);
  }
  
  function Select($table,$fields,$qry)
  {
    //echo "select $fields from $table $qry<p>"; 
    $res=mysql_query("select $fields from $table $qry", 
      $this->Sql_Connection);
    while ($row=$this->Fetch($res)){
      $result[]=$row;
    }
    return $result;
  }
  
  function Select_($qry)
  {
   //echo "$qry<p>"; 
    $res=mysql_query($qry, $this->Sql_Connection);
    while ($row=$this->Fetch($res)){
      $result[]=$row;
    }
    return $result;
  }
  

  function SelectAll($table,$fields)
  {
    $res = mysql_query("select $fields from $table", 
      $this->Sql_Connection);
      
 //    echo "select $fields from $table";

    //$result[]=array();
          
    while ($row=$this->Fetch($res)){
      $result[]=$row;
    }
      
 //   print $row;
     
    return $result;

  }
  
  function CheckError($succes,$error){
    if (mysql_error()<>"") 
    { 
      die($error.mysql_error()); 
    }
    else
    {
      echo $succes;
    }
  
  }

  function Row_Count($qry){
    $res=mysql_query($qry, $this->Sql_Connection);

    return array(mysql_num_rows($res),$this->Fetch($res)); 
  }

  function Row_Count_($qry){
    $res=mysql_query($qry, $this->Sql_Connection);

    while ($row=$this->Fetch($res)){
      $result[]=$row;
    }

    return array(mysql_num_rows($res),$result); 
  }

  function Get_Last_ID(){
    return mysql_insert_id();
  }
  
	function TestConnection($dbhost, $dbname, $dbuname, $dbupass)
	  {
		//error_reporting(0);
    $this->Sql_Connection = @mysql_connect($dbhost, $dbuname, $dbupass);
		//echo mysql_error();		
		if (!$this->Sql_Connection)
		{
			return mysql_error();
			exit;
		}
		
    if (!(@mysql_select_db($dbname, $this->Sql_Connection)))
		{
			return mysql_error();
			exit;			
		}
		mysql_close($this->Sql_Connection);
		return "";
		}
} 

?>
