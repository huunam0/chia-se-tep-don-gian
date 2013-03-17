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

require("include/common.php");

$fcode=strtoupper(CheckGVar('fcode'));
$dcode=strtoupper(CheckGVar('dcode'));

global $MyDB, $picfiletypes,$siteurl;

$smarty->display('header.tpl'); 

$smarty->assign('siteurl',$siteurl);


if (CheckOnlyDownTime()==-1)
{
  $smarty->display("messages/notimedown.tpl");
  $smarty->display('footer.tpl');
	die();
}


if ( ($fcode) && ($dcode) )
{
  if (CheckDownloadId($MyDB,$fcode))
  {
    $f_info=GetFileInfo($MyDB, $fcode);
    $smarty->assign('a_filename',$f_info[0]);
    $smarty->assign('a_filesize',$f_info[1]);
    $smarty->assign('a_downloaded',$f_info[2]);
    $smarty->assign('a_lastdown',$f_info[3]);
    $smarty->assign('fcode',$fcode);
    $smarty->assign('dcode',$dcode);
    $smarty->display("forms/filedelete.tpl");
  }
  else
  {
    $smarty->display("messages/nofilecode.tpl");  
  }
}
else
{  

  if ($fcode) 
  {
    if (CheckDownloadId($MyDB,$fcode))
    {
      $f_info=GetFileInfo($MyDB, $fcode);
      $smarty->assign('a_filename',$f_info[0]);
      $smarty->assign('a_filesize',$f_info[1]);
      $smarty->assign('a_downloaded',$f_info[2]);
      $smarty->assign('a_lastdown',$f_info[3]);
      $smarty->assign('fcode',$fcode);
      $smarty->assign('ufilecode',$fcode);
			
			$pics=explode(",",$picfiletypes);
			
			$filext= end(explode(".", $f_info[0]));

			$ispic=0;
			if (in_array($filext,$pics)) {
				$ispic=1; 
			}
		
			if ($ispic==1)
			{
					$smarty->display("forms/filepic.tpl");
			}
			else
			{
				if ($filext=="mp3")
				{
					$smarty->display("forms/filemp3.tpl");
				}
				else
				{
				  if ($filext=="flv")
  				  {
					$smarty->display("forms/fileflv.tpl");
				  }
				  else
				  {
					if ($f_info[2]<>0)
					{
						$smarty->display("forms/fileinfo.tpl");
					}
					else
					{
						$smarty->display("messages/fileinfo_nodl.tpl");				
					}
				  }
				}
			}
			
    }
    else
    {
      $smarty->display("messages/nofilecode.tpl");  
    }
  
	}
  else
  {
    $smarty->display("messages/nofilecode.tpl");
  }

}

$smarty->display('footer.tpl');
$MyDB->Close();

?>
