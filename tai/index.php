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
=
= @changedby  $Author: skyr $
= @revision   SVN: $Revision: 6 $
= @date       $Date: 2008-10-10 09:54:25 +1100 (Пт, 10 окт 2008) $
===============================================================================
*/




require("include/common.php");

global $MyDB;

DeleteOldFiles($MyDB);

$p=strtoupper(CheckGVar('p'));

//echo $p;

$smarty->display('header.tpl'); 

switch($p) {
case "TOS" : $smarty->display("tos.tpl"); break; 
case "FAQ" : $smarty->display("faq.tpl"); break;
default: $smarty->display("index.tpl"); break; 
}

$MyDB->Close();
//echo _("Site Name");
$smarty->display('footer.tpl');

//svn propset svn:keywords "Date Author ID Revision HeadURL" index.php
?>
