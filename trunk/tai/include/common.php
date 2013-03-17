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

  
require('class/smarty/Smarty.class.php');
require('class/archive.php');

$smarty = new Smarty();

if (!file_exists("config.php"))
{
	header("Location: setup.php");
	die();
}
require('config.php');

if ($INSTALLED==0)
{
	header("Location: setup.php");
	die();
}


$smarty->assign('sitename', $sitename);
$smarty->assign('siteurl', $siteurl);
$smarty->assign('charset',$charset);
$smarty->assign('delfileafter',$delfileafter);
$smarty->assign('maxfilesize',$maxfilesize);
$smarty->assign('uptimelimit',$uptimelimit);
$smarty->assign('downtimelimit',$downtimelimit);
$ftype=explode(",",$allowedfiletypes);
//print_r($ftype);
$allowedfiletypes=$ftype;
//echo join(", ",$ftype);
$smarty->assign('allowedfiletypes',join(", ",$ftype));
//$smarty->assign('allowedfiletypes',$ftype);

putenv("LANG=$lang");
setlocale (LC_ALL,"$lang.utf8");
$domain = 'messages';
bindtextdomain($domain, "./locale"); 
textdomain ($domain);
bind_textdomain_codeset($domain, "$charset");

require('class/db.php');
require('class/class_sql_inject.php');
require('include/functions.php');
require('include/upload.php');
require('include/download.php');
require('include/admin.php');
require('include/delete.php');
require('include/info.php');

if ($_SERVER["QUERY_STRING"] != "")
{
   $SqlAntiInjector = new sql_inject('cache/sqlinject.log',true,'index.php');
   $SqlAntiInjector->test($_SERVER["QUERY_STRING"]);
}

$MyDB = new MySQLDB;
$MyDB->connect($dbhost, $dbname, $dbuname, $dbupass);

$smarty->template_dir = "themes/$theme";
$smarty->compile_dir = 'cache';
$smarty->cache_dir = 'cache';

require("locale/$lang/lang.php");

$banreason=CheckIPForBan();

if ($banreason!="-1")
{
  $smarty->assign('banip',$banreason[0]);
  $smarty->assign('banreason',$banreason[1]);
  $smarty->display("header.tpl");
  $smarty->display("messages/banned.tpl");
  $smarty->display("footer.tpl");
  die("");
}

if ($mod_rewrite) {
  $smarty->assign('getfileurl','/');
}
else
{
  $smarty->assign('getfileurl','/info.php?fcode=');
}

?>
