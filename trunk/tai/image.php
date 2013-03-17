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

$smarty->display('header.tpl'); 

$fcode=strtoupper(CheckGVar('fcode'));
$gf=CheckGVar('gf');
$galmode=strtolower(CheckGVar('gm'));

echo "<img src=\"/picture.php?fcode=$fcode&gf=$gf&gm=$galmode\" border=\"0\">";

$MyDB->Close();

$smarty->display('footer.tpl');

?>
