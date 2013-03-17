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

  	
function GetAllFiles($mydb)
{
  $res = $mydb->Query("SELECT * FROM files");
  
  $files=array();
 
  while ($row=$mydb->Fetch($res))
  {
    $fileinfo[] = array("name"=>$row[file_name],"fsize"=>$row[file_size],"fcode"=>$row[file_code],"fip"=>$row[file_ip],"fdid"=>$row[delete_id],"fdcnt"=>$row[down_count],"fldown"=>$row[last_down]);
    
  } 

return $fileinfo; 
	
}


function GetAllBans($mydb)
{
  $res = $mydb->Query("SELECT * FROM bans");
  
  $bans=array();
 
  while ($row=$mydb->Fetch($res))
  {
    $bans[] = array("ip"=>$row[ban_ip],"reason"=>$row[reason]);
    
  } 

return $bans; 
	
}


function BanIP($mydb, $ip, $reason)
{ 
  //echo "pre ban".$ip, $reason;  
  $res = $mydb->Query("insert into bans (ban_ip,reason) values ('$ip', '$reason')");
  echo mysql_error();
  return $code;	
}


function UnBanIP($mydb, $ip)
{ 
  $res = $mydb->Query("delete from bans where ban_ip='$ip'");
  echo mysql_error();
  return $code;	
}

function DeleteOldFiles($mydb)
{
	global $delfileafter;
	$curtime=time();

	$pasttime = strtotime("-$delfileafter day", $curtime);

	$deltime=strftime("%G-%m-%d",$pasttime);
	
	//echo $deltime;
	
  $res = $mydb->Select_("SELECT * FROM files where last_down<'$deltime'");
	$fileids="";
	if ($res<>"")
	{
		foreach ($res as $delf)
		{
			$fileids.=$delf[fileid].",";
		}
		$fileids=substr($fileids,0,-1);
		echo $fileids;
		$mydb->Delete("files","fileid in ($fileids)");
}
}


?>
