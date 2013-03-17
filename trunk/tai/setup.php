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

if (file_exists("config.php"))
{
	require('config.php');
	if ($INSTALLED==1)
	{
		header("Location: index.php");
	}
}

require('class/smarty/Smarty.class.php');

require('class/db.php');
require('class/class_sql_inject.php');
require('include/functions.php');

$smarty = new Smarty();

$smarty->template_dir = "themes/default";
$smarty->compile_dir = 'cache';
$smarty->cache_dir = 'cache';


$lng=CheckGVar('lng');

if (trim($lng)=="")
{
	$lng=CheckPVar('lng');
}

if (trim($lng)=="")
{
$smarty->display('header_setup.tpl');
		
$smarty->display('setup/setup_lang.tpl');

$smarty->display('footer.tpl');

die();

}

if ($lng=="ru")
{
$lang="ru_RU";
$smarty->assign("lng","ru");
}

if ($lng=="en")
{
$lang="en_US";
$smarty->assign("lng","en");
}

$charset="UTF-8";

putenv("LANG=$lang");
setlocale (LC_ALL,"$lang.utf8");
$domain = 'messages';
bindtextdomain($domain, "./locale"); 
textdomain ($domain);
bind_textdomain_codeset($domain, "$charset");


if ($_SERVER["QUERY_STRING"] != "")
{
   $SqlAntiInjector = new sql_inject('cache/sqlinject.log',true,'index.php');
   $SqlAntiInjector->test($_SERVER["QUERY_STRING"]);
}

require("locale/$lang/lang.php");


$smarty->display('header_setup.tpl');


$p=strtoupper(CheckGVar('step'));

if (trim($p)=="")
{
$p=strtoupper(CheckPVar('step'));
}


$dhost=CheckPVar('step');
$dname=CheckPVar('step');
$duname=CheckPVar('step');
$dpass=CheckPVar('step');
//echo $p;

//$MyDB = new MySQLDB;
//$MyDB->connect($dbhost, $dbname, $dbuname, $dbupass);

///step2
if	($p=="STEP2"){
	$dataperm =	substr(sprintf('%o',fileperms('../data')),-3);
	$thumbperm =	substr(sprintf('%o',fileperms('../thumb')),-3);
	$cacheperm = substr(sprintf('%o',fileperms('cache')),-3);
	if (file_exists("config.php")){
	$configphp = substr(sprintf('%o',fileperms('config.php')),-3);
	}
	
	if ($dataperm<>"777")
	{
		$smarty->assign("dataperm","<span class=redstr>Error - $dataperm, must be 777</span>");
	}
	else
	{
		$smarty->assign("dataperm","<span class=greenstr>OK</span>");
	}
	
	
	
 if ($thumbperm<>"777")
	{
		$smarty->assign("thumbperm","<span class=redstr>Error - $thumbperm, must be 777</span>");
	}
	else
	{
		$smarty->assign("thumbperm","<span class=greenstr>OK</span>");
	}

 if ($cacheperm<>"777")
	{
		$smarty->assign("cacheperm","<span class=redstr>Error - $cacheperm, must be 777</span>");
	}
	else
	{
		$smarty->assign("cacheperm","<span class=greenstr>OK</span>");
	}

	if (file_exists("config.php"))
	{
		if ($configphp<>"666")
		{
			$smarty->assign("configphp","<span class=redstr>Error - $configphp, must be 666</span>");
		}
		else
		{
			$smarty->assign("configphp","<span class=greenstr>OK</span>");
		}
	}
	else
	{
		$cfg=fopen("config.php","w");
		fputs($cfg,"<?php \$INSTALLED=0; ?>");
		fclose($cfg);
		
		$configphp="644";		
		$smarty->assign("configphp","<span class=greenstr>Created! Error - $configphp, must be 666</span>");
	}
	
	if (($dataperm=="777") && ($cacheperm=="777") && ($configphp=="666") && ($thumbperm=="777"))
	{
		$smarty->assign("isok","1");		
	}
	else
	{
		$smarty->assign("isok","0");		
	}
	
}
///eob step2

if	($p=="STEP3"){
	$pass=CheckPVar('pass');
	//echo "pas=".$pass;
	if (trim($pass)<>"")
	{
		$dhost=CheckPVar('host');
		$dname=CheckPVar('db');
		$uname=CheckPVar('uname');
		$tpref=CheckPVar('pref');
		
		//$dbhost, $dbname, $dbuname, $dbupass
		$MyDB = new MySQLDB;
		$result=$MyDB->TestConnection($dhost,$dname,$uname,$pass);
		//echo $result;
		if ($result<>"")
		{
			$smarty->assign("isok",0);
			$smarty->assign("error",$result);
		}
		else
		{
			$smarty->assign("isok",1);
			$smarty->assign("iserr",1);
 		  $_SESSION['host']=$dhost;
			$_SESSION['db']=$dname;
			$_SESSION['uname']=$uname;
			$_SESSION['pass']=$pass;
			$_SESSION['tpref']=$tpref;
		}
				
	}
	else
	{
			$smarty->assign("iserr",1);
		
	}

}

if	($p=="STEP4")
{
			$surl=filter_var($_SERVER['SERVER_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);
			$smarty->assign("hosturl",$surl);

			$save=CheckPVar('save');
			if ($save=="ok")
			{
				$fcfg=fopen("config.php","w");
				
				$sitename=CheckPVar('sitename');
				$lang=CheckPVar('lang');
				$siteurl=CheckPVar('siteurl');
				$apass=CheckPVar('apass');
				$uplim=CheckPVar('uplim');
				$dnlim=CheckPVar('dnlim');
				$adel=CheckPVar('adel');
				$filetypes=CheckPVar('filetypes');
				$modrew=CheckPVar('modrew');
				
				
				$config="<?php
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
*/\n\n\$lang   = \"$lang\"; 
\$charset = \"UTF-8\";

\$theme = \"default\";

\$sitename=\"$sitename\";
\$siteurl=\"$siteurl\";

\$adminpasswwdd = \"$apass\";
 		  
\$dbhost  = \"".$_SESSION['host']."\";
\$dbname  = \"".$_SESSION['db']."\";
\$dbuname = \"".$_SESSION['uname']."\";
\$dbupass = \"".$_SESSION['pass']."\";
\$tableprefix = \"".$_SESSION['tpref']."\";

\$uptimelimit = $uplim;
\$downtimelimit = $dnlim;
\$delfileafter = $adel;

\$allowedfiletypes = \"$filetypes\";

\$picfiletypes= \"jpg,gif,jpeg,png\";

\$mod_rewrite=$modrew;

?>";
				fputs($fcfg,$config);
			
				fclose($fcfg);
			$smarty->assign("isok",1);
			}

}	
	
if	($p=="STEP5")
{
	require('config.php');

	$MyDB = new MySQLDB;
	$MyDB->connect($dbhost, $dbname, $dbuname, $dbupass);
	

	$bans="CREATE TABLE IF NOT EXISTS `bans` (
  `banid` int(11) NOT NULL auto_increment,
  `ban_ip` varchar(15) collate utf8_unicode_ci NOT NULL,
  `reason` longtext collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`banid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned users info' AUTO_INCREMENT=1;";


$files="CREATE TABLE IF NOT EXISTS `files` (
  `fileid` int(11) NOT NULL auto_increment,
  `file_name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL default '0',
  `file_code` varchar(7) collate utf8_unicode_ci NOT NULL,
  `file_ip` varchar(15) collate utf8_unicode_ci NOT NULL,
  `delete_id` varchar(15) collate utf8_unicode_ci NOT NULL,
  `down_count` int(11) NOT NULL default '0',
  `last_down` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`fileid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Uploaded files info' AUTO_INCREMENT=1 ;";


$ips="CREATE TABLE IF NOT EXISTS `ips` (
  `ipid` int(11) NOT NULL auto_increment,
  `ip` varchar(12) collate utf8_unicode_ci NOT NULL,
  `lastu` datetime NOT NULL,
  `lastd` datetime NOT NULL,
  PRIMARY KEY  (`ipid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='IP info for up and down timers' AUTO_INCREMENT=1 ;";

	$instprogr="Installing Bans...<p>";
	$MyDB->Query($bans);
	$instprogr.=mysql_error();
	$instprogr.="Installing Files...<p>";
	$MyDB->Query($files);
	$instprogr.=mysql_error();
	$instprogr.="Installing IP...<p>";
	$MyDB->Query($ips);
	$instprogr.=mysql_error();
	$instprogr.="OK!";

	$smarty->assign("instprogr",$instprogr);
	//echo mysql_error();
	
}	

if	($p=="STEP6")
{
	
	$fcfg=fopen("config.php","a+");

	$config="\n<?php\n".'$INSTALLED= 1;'."\n\n?>";

	fputs($fcfg,$config);
			
	fclose($fcfg);
}


switch($p) {
case "STEP2" : $smarty->display("setup/setup_perm.tpl"); break; 
case "STEP3" : $smarty->display("setup/setupdb.tpl"); break; 
case "STEP4" : $smarty->display("setup/setupcfg.tpl"); break; 
case "STEP5" : $smarty->display("setup/installdb.tpl"); break; 
case "STEP6" : $smarty->display("setup/finish.tpl"); break; 
default: $smarty->display("setup/setup.tpl"); break; 
}

//echo _("Site Name");
$smarty->display('footer.tpl');

?>
