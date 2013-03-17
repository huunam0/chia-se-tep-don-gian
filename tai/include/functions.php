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


function GetFileUloaderIp()
{ 
	return filter_var($_SERVER['REMOTE_ADDR'], FILTER_SANITIZE_SPECIAL_CHARS);	
} 


function CheckIPForBan()
{ 
  global $MyDB;
  
  $user_ip=GetFileUloaderIp();
  
  $res = $MyDB->Query("SELECT * FROM bans where ban_ip='$user_ip'");
  
  $row=$MyDB->Fetch($res);
  if (mysql_num_rows($res)!=0) 
  {
    return array($row[ban_ip], $row[reason]);
  }
  else
  {
    return -1;
  }	
} 

function CheckUpTime()
{ 
  global $MyDB, $uptimelimit;
  
  $user_ip=GetFileUloaderIp();

  $res = $MyDB->Select_("SELECT * FROM ips where ip='$user_ip'");

	if ($res<>"")
	{

		$lasttime=strtotime($res[0]['lastu']);

		$elapt = strtotime("+$uptimelimit minutes", $lasttime);

		if ($elapt<	time())
		{
			//echo date('H:i:s', $elapt)."<p>";
 		 $res = $MyDB->Modify("ips","`lastu`='".strftime("%G-%m-%d %H:%M:%S",time())."' ","ip='$user_ip'");
			return 1;
		}
		else
		{		
			return -1;
		}
		
		
	}
	else
	{

		$res = $MyDB->Insert("ips","`ip`,`lastu`","'".$user_ip."','".strftime("%G-%m-%d %H:%M:%S",time())."'");
		return 1;

	}

} 


function CheckDownTime()
{ 
  global $MyDB, $uptimelimit,$downtimelimit;
  
  $user_ip=GetFileUloaderIp();

  $res = $MyDB->Select_("SELECT * FROM ips where ip='$user_ip'");

	if ($res<>"")
	{

		$lasttime=strtotime($res[0]['lastd']);

		$elapt = strtotime("+$downtimelimit minutes", $lasttime);

		if ($elapt<	time())
		{
//			echo date('H:i:s', $elapt)."<p>";
 		 $res = $MyDB->Modify("ips","`lastd`='".strftime("%G-%m-%d %H:%M:%S",time())."' ","ip='$user_ip'");
			return 1;
		}
		else
		{		
			return -1;
		}
		
		
	}
	else
	{

		$res = $MyDB->Insert("ips","`ip`,`lastd`","'".$user_ip."','".strftime("%G-%m-%d %H:%M:%S",time())."'");
		return 1;

	}

} 


function CheckOnlyDownTime()
{ 
  global $MyDB, $uptimelimit,$downtimelimit;
  
  $user_ip=GetFileUloaderIp();

  $res = $MyDB->Select_("SELECT * FROM ips where ip='$user_ip'");

	if ($res<>"")
	{

		$lasttime=strtotime($res[0]['lastd']);

		$elapt = strtotime("+$downtimelimit minutes", $lasttime);

		if ($elapt<	time())
		{
//			echo date('H:i:s', $elapt)."<p>";
// 		 $res = $MyDB->Modify("ips","`lastd`='".strftime("%G-%m-%d %H:%M:%S",time())."' ","ip='$user_ip'");
			return 1;
		}
		else
		{		
			return -1;
		}
		
		
	}
	else
	{

		//$res = $MyDB->Insert("ips","`ip`,`lastd`","'".$user_ip."','".strftime("%G-%m-%d %H:%M:%S",time())."'");
		return 1;

	}

} 


function GetGVar($var_name)
{ 
	return  filter_input(INPUT_GET, $var_name, FILTER_SANITIZE_SPECIAL_CHARS);
}

function GetPVar($var_name)
{ 
	return  filter_input(INPUT_POST, $var_name, FILTER_SANITIZE_SPECIAL_CHARS);
} 

function substr_unicode($s,$b,$c)
{
    $sta=iconv("utf-8","cp1251",$s);
    $sta=substr($sta,$b,$c);
    $sta=iconv("cp1251","utf-8",$sta);
    return $sta;
}


function CheckGVar($var_name)
{
	$resul=GetGVar($var_name);
	//echo $resul; 
	if (isset($resul)) 
	{
		return $resul; 
	}
	else
	{
		return "";
	}	
}

function CheckPVar($var_name)
{
	$resul=GetPVar($var_name);
	if (isset($resul)) 
	{
		return $resul; 
	}
	else
	{
		return "";
	}	
}



?>
