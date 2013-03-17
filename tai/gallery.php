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

$fcode=strtoupper(CheckGVar('fcode'));
$dcode=strtoupper(CheckGVar('dcode'));

global $MyDB, $picfiletypes,$siteurl;

$smarty->display('header.tpl'); 


$smarty->assign('siteurl',$siteurl);


if ($fcode<>"")
{
  if (!CheckDownloadId($MyDB,$fcode))
  {
    $smarty->display("messages/nofilecode.tpl");
		$smarty->display('footer.tpl');
		$MyDB->Close();
		die();
  }
}
else
{
  $smarty->display("messages/nofilecode.tpl");  
		$smarty->display('footer.tpl');
		$MyDB->Close();
		die();
}

$f_info=GetFileInfo($MyDB, $fcode);

      $smarty->assign('a_filename',$f_info[0]);
      $smarty->assign('a_filesize',$f_info[1]);
      $smarty->assign('a_downloaded',$f_info[2]);
      $smarty->assign('a_lastdown',$f_info[3]);
      $smarty->assign('fcode',$fcode);
      $smarty->assign('ufilecode',$fcode);
if (!file_exists("../gallery/".$fcode))
{
	//echo "PLEASE Wait!";
//echo "Nooo";	
$zip = new ZipArchive;
$res = $zip->open("../data/".$fcode);

$extarr = array();
foreach (explode(",",$picfiletypes) as $ss)
{
  $extarr[]="*.".$ss;

}

$pics=explode(",",$picfiletypes);

//print_r($extarr);

$notallpics = 0;

if ($res === TRUE) {
    //echo 'ok';
   $files=array();
   for($i = 0; $i < $zip->numFiles; $i++)
     {  
	$fext=end(explode(".", $zip->getNameIndex($i)));
	$files[]=$zip->getNameIndex($i);
	//echo $fext;
	if (in_array($fext,$pics)==false)
	{
		$notallpics=1;
	}
     }
    //echo $notallpics;
    if ($notallpics==0)
    {


      $zip->extractTo("../gallery/$fcode",$files); //dir
      mkdir("gallery/$fcode");
      mkdir("gallery/$fcode/thumb");
      foreach ($files as $fnams)
      {

      list($width, $height) = getimagesize("../gallery/$fcode/".$fnams);
      $filext=end(explode(".", $fnams));


      $size = 0.3;
      $modwidth = $width * $size;
      $modheight = $height * $size;
      $tn = imagecreatetruecolor($modwidth, $modheight) ;
      //echo $filext;
      switch( $filext )
      {
        case "gif": $image = imagecreatefromgif("../gallery/$fcode/".$fnams); break;
        case "png": $image = imagecreatefrompng("../gallery/$fcode/".$fnams); break;
        case "jpeg": $image = imagecreatefromjpeg("../gallery/$fcode/".$fnams); break;
        case "jpg": $image = imagecreatefromjpeg("../gallery/$fcode/".$fnams); break;
      }
      //$image = imagecreatefromjpeg("../data/".$upfilecod) ;
      imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
      
      imagejpeg($tn,"gallery/$fcode/"."thumb/".$fnams."_.jpg", 50) ;

      }

      $zip->close();
			
			
			
	$htmlgal="";
	$htmlgal.="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
	$colnum=3;	
      if (is_dir("gallery/$fcode/"."thumb")) {
	if ($dir = opendir("gallery/$fcode/"."thumb")) {
		$col=0;
		while (false !== ($filename=readdir($dir))) 
		{
		  if (($filename<>".") && ($filename<>"..") && ($filename<>"thumb"))
		  {
		    $fn=str_replace("_.jpg","",$filename);
		    $fn=str_replace(" ","%20",$fn);
				if ($col==0) 
				{
					$htmlgal.="<tr>";
				}
				$htmlgal.="<td align=\"center\" valign=\"middle\"><a href=\"http://".$siteurl."/image.php?fcode=$fcode&amp;gf=$fn&amp;gm=f\" target=\"_blank\"><img src=\"http://".$siteurl."/gallery/$fcode/thumb/$fn"."_.jpg\" border=\"0\" alt=\"$fn\"></a></td>";
				$col++;
				if ($col==$colnum) 
				{
					$htmlgal.="</tr>\n";
					$col=0;
				}
		  }
	  }

closedir($dir);
	}
}
	$htmlgal.="</tr></table>";
	
  $smarty->assign('htmlgal',$htmlgal);

	
	
		
		$smarty->display("messages/galcreated.tpl");
		$smarty->display('footer.tpl');
		$MyDB->Close();
		die();
			
}

} else {
    echo 'failed, code:' . $res;
}

}
else
{
	$smarty->display('forms/gallery.tpl'); 
}
	$htmlgal="";
	echo "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
	$htmlgal.="&#60;table border=0 cellpadding=0 cellspacing=0>";
	$colnum=3;	
      if (is_dir("gallery/$fcode/"."thumb")) {
	if ($dir = opendir("gallery/$fcode/"."thumb")) {
		$col=0;
		while (false !== ($filename=readdir($dir))) 
		{
		  if (($filename<>".") && ($filename<>"..") && ($filename<>"thumb"))
		  {
		    $fn=str_replace("_.jpg","",$filename);
		    $fn=str_replace(" ","%20",$fn);
				if ($col==0) 
				{
					echo "<tr>";
					$htmlgal.="<tr>";
				}
					echo "<td align=center valign=middle><a href=\"image.php?fcode=$fcode&amp;gf=$fn&amp;gm=f\" target=\"_blank\"><img src=\"gallery/$fcode/thumb/$fn"."_.jpg\" border=\"0\" alt=\"$fn\"></a></td>";
					$htmlgal.="&#60;td align=center valign=middle>&#60;a href=image.php?fcode=$fcode&amp;gf=$fn&amp;gm=f target=_blank>&#60;img src=gallery/$fcode/thumb/$fn"."_.jpg border=0>&#60;/a>&#60;/td>";
				$col++;
				if ($col==$colnum) 
				{
					echo "</tr>\n";
					$htmlgal.="&#60;/tr>\n";
					$col=0;
				}
		  }
	  }

closedir($dir);
	}
}

	echo "</tr></table></center>";
	$htmlgal.="&#60;/tr></table>";
	$htmlgal=str_replace("&","&amp;",$htmlgal);
	$htmlgal=str_replace("<","&#60;",$htmlgal);
	
  $smarty->assign('htmlgal',$htmlgal);

		$smarty->display('footer.tpl');
		$MyDB->Close();
		die();

?>