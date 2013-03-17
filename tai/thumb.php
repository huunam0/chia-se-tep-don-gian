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

/*

<?php

function dl_file($file){

    //First, see if the file exists
    if (!is_file($file)) { die("<b>404 File not found!</b>"); }

    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
          case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpg"; break;
      case "mp3": $ctype="audio/mpeg"; break;
      case "wav": $ctype="audio/x-wav"; break;
      case "mpeg":
      case "mpg":
      case "mpe": $ctype="video/mpeg"; break;
      case "mov": $ctype="video/quicktime"; break;
      case "avi": $ctype="video/x-msvideo"; break;

      //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
      case "php":
      case "htm":
      case "html":
      case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;

      default: $ctype="application/force-download";
    }

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
   
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");


    echo $filename;
    //Force the download
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    @readfile($file);
    exit;
}

?>

*/

require('include/common.php');

$fcode=strtoupper(CheckGVar('fcode'));

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

//echo $f_info[0],$filext;
$ispic=0;
if (in_array($filext,$pics)) {
//echo "--".basename($f_name);
$ispic=1; 
}
//echo "../thumb/".$fcode."jpg";


if ( ($fcode!= "") && ($ispic==1)) 
{
  IncDownloadedCounter($MyDB, $fcode);
//  echo "--".basename($f_name);
	$filext= end(explode(".", $f_info[0]));
	//echo "../thumb/".$fcode."jpg";
  _SendPicture("../thumb/".$fcode.".jpg",$fcode.".jpg", $f_info[1],"jpg");
}
else
{
	die();
}



$MyDB->Close();

?>
