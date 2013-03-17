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

global $MyDB;

$banned=false;

if (CheckDownTime()==-1)
{
  header("Location: info.php");
	$smarty->display('header.tpl'); 
  $smarty->display("messages/notimedown.tpl");
  $smarty->display('footer.tpl');
  $banned=true;
	die();
}



$f_info=CheckDnFile($MyDB, $fcode);


//echo $f_info;

if (($f_info==-1) or ($f_info==-2))
{
  $smarty->display('header.tpl'); 
  $smarty->display("messages/nofilecode.tpl");
  $smarty->display('footer.tpl');
  $MyDB->Close();
  die();

}

if ($fcode!= "") 
{
  IncDownloadedCounter($MyDB, $fcode);
  _Download("../data/".$fcode,$f_info[0], $f_info[1]);
}
else
{
  $smarty->display('header.tpl'); 
  $smarty->display("messages/nofilecode.tpl");
  $smarty->display('footer.tpl');
}



$MyDB->Close();

?>
