<?php
/*
===============================================================================
=     Php Open FileSharing
=
=     Copyright (c) 2007 Vasiliy Altunin
=     http://phpofs.sf.net
=     skyr@users.sourceforge.net
=
=     Released under the terms and conditions of the
=     GNU General Public License (http://gnu.org).
=
===============================================================================
*/


function BuildUpFileCode()
{ 
  $rnd1=rand('1','99999');
  $rnd2=rand('65','90');
  $rnd3=rand('65','90');
  $filecode=chr($rnd2).chr($rnd3).$rnd1;
  return $filecode;	
} 

function GetUpFileSize()
{ 
  return $_FILES['upfile']['size'];	
} 

function GetUpFileName()
{ 
  return strtolower($_FILES['upfile']['name']);	
} 

function GetUpFileTempName()
{ 
  return $_FILES['upfile']['tmp_name'];	
} 


function CheckFileCode($mydb, $code)
{ 
  $res = $mydb->Query("SELECT count(fileid) as fid FROM files where file_code='$code'");
  
  $row=$mydb->Fetch($res);
  if ($row[fid]!=0) {
    $code=CheckFileCode($mydb,BuildUpFileCode());
  }
  return $code;	
} 


function CheckFileExt($filename)
{ 
  global $allowedfiletypes;
//  list($fname,$fext) = explode(".",$filename);
list($fname,$fext) = array(explode(".",$filename),end(explode('.', $filename)));
  //echo $allowedfiletypes;
	foreach($allowedfiletypes as $ft) 
  {
      if ($fext==$ft) 
      {
        return true;
        exit;
      }
  }
  return false;	
} 


function InsertNewFileInDb($mydb, $fname, $fsize, $fcode, $fip, $fdid)
{ 
  $dt=strftime("%G-%m-%d",time());
	$res = $mydb->Query("insert into files (file_name, file_size, file_code, file_ip, delete_id,last_down)  values ('$fname', '$fsize','$fcode', '$fip', '$fdid','$dt')");
  //echo mysql_error();
  return $code;	
} 

?>
