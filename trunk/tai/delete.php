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

session_start();

require('include/common.php');

$fcode=strtoupper(CheckGVar('fcode'));
$dcode=strtoupper(CheckGVar('dcode'));

global $MyDB,$picfiletypes;

if ( ($fcode!= "") && ($dcode!= "") ) 
{

$f_info=CheckDnFile($MyDB, $fcode);

if ($f_info==-1) 
{
}

if ($f_info==-2) 
{
  $smarty->display('header.tpl'); 
  $smarty->display("messages/nofileip.tpl");
  $smarty->display('footer.tpl');
	die();
}

//print_r($f_info);
$filext= end(explode(".", $f_info[0]));
$pics=explode(",",$picfiletypes);

  $ispic=0;
  if (in_array($filext,$pics)) {
      $ispic=1;
  }


if (CheckDeleteId($MyDB,$dcode))
{
  unlink("../data/".$fcode);
  if ($ispic==1)
  {
	  unlink("../thumb/".$fcode.".jpg");
  }
  DeleteFileFromDB($MyDB,$fcode);
  $smarty->display('header.tpl'); 
  $smarty->display("messages/filedeleted.tpl");
  $smarty->display('footer.tpl');

}
else
{
  $smarty->display('header.tpl'); 
  $smarty->display("messages/nofilecode.tpl");
  $smarty->display('footer.tpl');
}

}
else
{
  $smarty->display('header.tpl'); 
  $smarty->display("messages/nofilecode.tpl");
  $smarty->display('footer.tpl');
}


?>
