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

require('include/download.php');
require('include/functions.php');

$fcode=strtoupper(CheckGVar('fcode'));
$gf=strtolower(CheckGVar('gf'));
$galmode=strtolower(CheckGVar('gm'));


if ( ($fcode<>"") && ($gf<>""))
{
  $gf=str_replace("/","",$gf);
  $gf=str_replace("\\","",$gf);
  $filext= end(explode(".", $gf));
//  echo "../gallery/".$fcode."/".$gf;
	//echo "../gallery/".$fcode."/".$gf;
  if (!file_exists("gallery/".$fcode."/".$gf) ) 
  {
	echo "Wrong file code!";
	die();
  }
  
  switch ($galmode)
  {
   case "t" : _SendGalPicture("gallery/".strtolower($fcode)."/thumb/".strtolower($gf)."_.jpg",strtolower($gf),strtolower($filext));
   case "f" : _SendGalPicture("gallery/".strtolower($fcode)."/".strtolower($gf),strtolower($gf),strtolower($filext));
   default : _SendGalPicture("gallery/".strtolower($fcode)."/thumb/".strtolower($gf)."_.jpg",strtolower($gf),strtolower($filext));
  }
	die();
}

?>
