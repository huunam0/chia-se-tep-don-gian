<?php

/*
===============================================================================
=     Php Open FileSharing
=
=     Copyright (c) 2007-2009 Vasiliy Altunin
=     http://phpofs.sf.net
=     skyr at users.sourceforge.net
=
=     Released under the terms and conditions of the
=     GNU General Public License (http://gnu.org).
=
===============================================================================
*/

require("include/common.php");

$smarty->display('header.tpl'); 

global $p, $TOS, $FAQ, $theme, $MyDB,$picfiletypes;

$banned=false;
$fn = GetUpFileName();
$fs = GetUpFileSize();

if (CheckUpTime()==-1)
{
  $smarty->display("messages/notimeup.tpl");
  $banned=true;
	
}

if ( GetUpFileSize()==0 ) 
{
  $smarty->display("messages/nofile.tpl");
  $banned=true; 
}
else
{
  $upfilecod = CheckFileCode($MyDB, BuildUpFileCode());
  
  if (GetUpFileSize())  
  {
    if (!CheckFileExt($fn))
    {
      $smarty->display("messages/notallow.tpl");
      $banned=true; 
    }
  }
}

if (!$banned) 
{
  $delfilecode = BuildUpFileCode();
  $smarty->assign('ufilename',$fn);
  $smarty->assign('ufilesize',$fs);
  $smarty->assign('ufilecode',$upfilecod);
  $smarty->assign('ufiledcode',$delfilecode);

  $filext= end(explode(".", $fn));

  move_uploaded_file(GetUpFileTempName(),"../data/".$upfilecod);
  
  
  $pics=explode(",",$picfiletypes);
  
  
  $ispic=0;
  if (in_array($filext,$pics)) {
      $ispic=1;
  }
  
  if ($ispic==1)
  {
      list($width, $height) = getimagesize("../data/".$upfilecod) ;
      //echo $width,$height;
      if (($width=="") or ($height==""))
      {
        $smarty->display("messages/notallow.tpl");
        $banned=true; 

	$MyDB->Close();
	
	$smarty->display('footer.tpl');
	die();
      }

      $size = 0.3;
      $modwidth = $width * $size;
      $modheight = $height * $size;
      $tn = imagecreatetruecolor($modwidth, $modheight) ;
      //echo $filext;
      switch( $filext )
      {
        case "gif": $image = imagecreatefromgif("../data/".$upfilecod) ; break;
        case "png": $image = imagecreatefrompng("../data/".$upfilecod) ; break;
        case "jpeg": $image = imagecreatefromjpeg("../data/".$upfilecod) ; break;
        case "jpg": $image = imagecreatefromjpeg("../data/".$upfilecod) ; break;
      }
      //$image = imagecreatefromjpeg("../data/".$upfilecod) ;
      imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
      
      imagejpeg($tn,"../thumb/".$upfilecod.".jpg", 50) ;
      $smarty->display('messages/uploadedpic.tpl');
  }
  else
  if ($filext=="mp3")
  {
      $smarty->display('messages/uploadedmp3.tpl');      
  }
  else
  {
    if ($filext=="flv")
    {
        $smarty->display('messages/uploadedflv.tpl');      
    }
    else
    {
			if ($filext=="zip")
			{
        $smarty->display('messages/uploadedzip.tpl');      
			}
			else
			{
        $smarty->display('messages/uploaded.tpl');
			}
    }
  }
  
    InsertNewFileInDb($MyDB,$fn,$fs,$upfilecod,GetFileUloaderIp(),$delfilecode);
}


$MyDB->Close();

$smarty->display('footer.tpl');

?>
