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

require("include/common.php");

global $MyDB;

//if( !isset($_GET['a']) ){ $p = ""; } else { $p = strtoupper(GetVars('a')); }
$p=strtoupper(CheckGVar('a'));
$passwr=CheckPVar('passw');
$loged=strtoupper(CheckPVar('logged'));
$bbok=CheckGVar('bok');
$ipp=CheckGVar('ip');
$okk=strtoupper(CheckGVar('ok'));
$reaso=CheckGVar('reason');

//echo $p."<p>"; 
//echo $passwr."<p>"; 
//echo $loged."<p>"; 

if  ($p=="LOUT")  
{
  //echo "1111";
  session_destroy();
  $_SESSION['logged']="";
  $_SESSION['passw']="";
  $_POST['logged']="";
  die("<a href=index.php>Back to main</a>"); 
} 

$smarty->display('header.tpl');

if (!isset($_SESSION['passw']))
{
  
  if (($loged=="") && ($passwr==""))
  {
    echo "
    <p>Admin password:</p>
    <form action=admin.php method=post>
    <input name='passw' type=password>
    <input type='hidden' name='logged' value='ok'>
    <input type='submit' value='login'>
    </form>
    ";
    
  }
  else
  {
    global $adminpasswwdd;
   
    if ($passwr==$adminpasswwdd)
    {
      $_SESSION['logged']=$loged;
      $_SESSION['passw']="";
      $_POST['logged']='ok';
      echo "<a href=admin.php>Go to admin</a>";
    }
    else
    {
      echo "Wrong pass";
    }
    
  }
  
}
else
{
  if  (strtoupper($p)=="BAN")   
  {
		
		//echo $bbok."===".$ipp."==".$okk;	

		if ( ($okk=="") && ($bbok==""))
		{
    $smarty->assign('bans',GetAllBans($MyDB));
          
		$smarty->display('admin/admin_ban.tpl');
		$smarty->display('footer.tpl');
		die();	
    }


    if (($bbok<>"") && ($ipp<>""))
    {
		echo $bbok."===".$ipp."==".$okk;	
      UnBanIP($MyDB, $ipp);
      echo $ipp." unbanned!<p>";
      echo "<a href=admin.php>Go to admin</a>";
 		  $smarty->display('footer.tpl');
			die();
    }
				
      if (($ipp=="") || ($reaso==""))						
      {
        
        $smarty->assign('iptoban',$ipp);
        
        $smarty->display('admin/admin_ban_form.tpl');

				$smarty->display('footer.tpl');
				die();
        
      }

      if ($reaso<>"")
      {         
          //echo $_GET['reason'],GetVars('reason')."<p>";
          BanIP($MyDB, $ipp,$reaso);
          echo $ipp." banned for ".$reaso."!<p>";
          echo "<a href=admin.php>Go to admin</a>";

				$smarty->display('footer.tpl');
				die();
        
      }
      
    }	
  else
  {
    global $MyDB;
    
    $smarty->assign('filesinfos',GetAllFiles($MyDB));
    
    $smarty->display('admin/admin.tpl');
    
  }
}


    $smarty->display('footer.tpl');


?>
