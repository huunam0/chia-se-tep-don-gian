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

$f_info=CheckDnFile($MyDB, $fcode);

$pics=explode(",",$picfiletypes);
			
$filext= end(explode(".", $f_info[0]));

$ispic=0;
if (in_array($filext,$pics)) {
$ispic=1; 
}


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




$MyDB->Close();

?>
