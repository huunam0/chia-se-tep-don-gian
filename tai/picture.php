<?php

/*
===============================================================================
=     Php Open FileSharing
=
=     Copyright (c) 2007-2008 Vasiliy Altunin
=     http://phpofs.sf.net
=     skyr at users.sourceforge.net
=
=     Released under the terms and conditions of the
=     GNU General Public License (http://gnu.org).
=
===============================================================================
*/

require('include/common.php');

$fcode=strtoupper(CheckGVar('fcode'));
$gf=CheckGVar('gf');
//echo $gf;;
$galmode=strtolower(CheckGVar('gm'));


if ( ($fcode<>"") && ($gf<>""))
{
  $gf=str_replace("/","",$gf);
  $gf=str_replace("\\","",$gf);
  $filext= end(explode(".", $gf));
//  echo "../gallery/".$fcode."/".$gf;
	//echo "../gallery/".$fcode."/".$gf;
  if (!file_exists("../gallery/".$fcode."/".$gf) ) 
  {
	echo "Wrong file code!";
	die();
  }
  
  switch ($galmode)
  {
   case "t" : _SendGalPicture("gallery/".strtoupper($fcode)."/thumb/".$gf."_.jpg",$gf,strtolower($filext));
   case "f" : _SendGalPicture("../gallery/".strtoupper($fcode)."/".$gf,$gf,strtolower($filext));
   default : _SendGalPicture("gallery/".strtoupper($fcode)."/thumb/".$gf."_.jpg",$gf,strtolower($filext));
  }
	die();
}

global $MyDB;

$banned=false;

/*if (CheckDownTime()==-1)
{
  header("Location: info.php");
	$smarty->display('header.tpl'); 
  $smarty->display("messages/notimedown.tpl");
  $smarty->display('footer.tpl');
  $banned=true;
	die();
}
*/


$f_info=CheckDnFile($MyDB, $fcode);

$pics=explode(",",$picfiletypes);
			
$filext= end(explode(".", $f_info[0]));

$ispic=0;
if (in_array($filext,$pics)) {
$ispic=1; 
}

//  echo "../gallery/".$fcode."/".$gf;


if ( ($fcode!= "") && ($ispic==1))
{
  IncDownloadedCounter($MyDB, $fcode);
	$filext= end(explode(".", $f_info[0]));
  _SendPicture("../data/".$fcode,$f_info[0], $f_info[1],$filext);
}
else
{
	if ( ($fcode!= "") && ($filext=="mp3"))
	{
		IncDownloadedCounter($MyDB, $fcode);
		$filext= end(explode(".", $f_info[0]));
		_SendMp3("../data/".$fcode,$f_info[0], $f_info[1],$filext);
	}
	else
	{
		die();
	}
}



$MyDB->Close();

?>
