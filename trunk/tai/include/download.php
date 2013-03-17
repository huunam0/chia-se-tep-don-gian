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

function CheckDnFile($mydb, $code)
{
  clearstatcache();
  $res = $mydb->Query("SELECT * FROM files where file_code='$code'");
  $row=$mydb->Fetch($res);
  //echo $row[file_name],$row[file_size],$code;	

//echo "SELECT * FROM files where file_code='$code'";
//echo $row[file_size]+0,"..." ,filesize('/www/share.pitnet.ru/data/'.$code)+0;
  

	if (!file_exists('../data/'.$code) ) 
	{
		return -1;
		exit;		
	}
  if ($row[file_size]+0 != filesize('../data/'.$code)+0 )  
	{
      die("Internal error! File size do not match!");
	} 
/*	if ($row[file_ip]<>GetFileUloaderIp())
	{
		return -2;
		exit;
	}
*/
  $res=array($row[file_name],$row[file_size]);
//  echo "22222";
//  print_r( $res);

  return $res; 
}

function GetFileInfo($mydb, $code)
{ 
  $res = $mydb->Query("SELECT * FROM files where file_code='$code'");
  
  $row=$mydb->Fetch($res);
  // for security reasons we check filesize in DB and filesize of file on disk 
  if ($row[file_size] != filesize('../data/'.$code) ) 
	{
    die("Internal error! File size do not match!");
  } 
  $res=array($row[file_name],$row[file_size],$row[down_count],$row[last_down],$row[delete_id]);

  return $res;
}
  
function IncDownloadedCounter($mydb, $fcode)
{ 
  $res = $mydb->Query("UPDATE `files` SET `down_count` = down_count+1, last_down = now() WHERE file_code = '$fcode'");
  echo mysql_error();
  return $code;	
}

function _Download($f_location,$f_name,$f_size){
    header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . $f_size);
//    $fnam="AA".str_replace("/","_",$f_name);
//    header('Content-Disposition: attachment; filename=' . $fnam );
    $f_name=str_replace(" ","_",$f_name);
    header('Content-Disposition: attachment; filename=' . basename($f_name));
    //echo basename($f_name);
    readfile($f_location);
}

function _SendPicture($f_location,$f_name,$f_size,$fext){
    $ctype="";
    switch  ($fext)
    {
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":$ctype="image/jpg"; break;
      case "jpg": $ctype="image/jpg"; break;
      default: die("Internal Error! Not supported picture file extension!");
    }
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header('Content-Type: $ctype');
    header('Content-Length: ' . $f_size);
    $f_name=str_replace(" ","_",$f_name);
    header('Content-Disposition: attachment; filename=' . basename($f_name));
    readfile($f_location);
}

function _SendGalPicture($f_location,$f_name,$fext){
    $ctype="";
    $f_size=filesize($f_location);
    switch  ($fext)
    {
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":$ctype="image/jpg"; break;
      case "jpg": $ctype="image/jpg"; break;
      default: die("Internal Error! Not supported picture file extension!");
    }
//    echo $f_location,"==",$f_name,$fext,$ctype;
//    header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
    header('Content-Description: File Transfer');
    header('Content-Type: $ctype');
    header("Content-Transfer-Encoding: binary"); 
    header('Content-Length: ' . $f_size);
    $f_name=str_replace(" ","_",$f_name);
    header('Content-Disposition: attachment; filename=' . basename($f_name));
    readfile($f_location);
}


function _SendMp3($f_location,$f_name,$f_size,$fext){
	$ctype="";
	if ($fext=="mp3")
	{
		$ctype="application/mp3"; 
	}
	else
	{
		die("Internal Error! Not supported picture file extension!");
	}
	
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header('Content-Type: $ctype');
    header('Content-Length: ' . $f_size);
    $f_name=str_replace(" ","_",$f_name);
    header('Content-Disposition: attachment; filename=' . basename($f_name));
    readfile($f_location);
}


function _SendFlv($f_location,$f_name,$f_size,$fext){
	$ctype="";
	if ($fext=="flv")
	{
		$ctype="video/x-flv"; 
	}
	else
	{
		die("Internal Error! Not supported video file extension!");
	}
	
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header('Content-Type: $ctype');
    header('Content-Length: ' . $f_size);
    $f_name=str_replace(" ","_",$f_name);
    header('Content-Disposition: attachment; filename=' . basename($f_name));
    readfile($f_location);
}

?>
