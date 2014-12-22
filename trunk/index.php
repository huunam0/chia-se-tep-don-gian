<?PHP
/*---------------------------------------#
/     Simplicity oF Upload == Jamal      /
/            Version 1.3.2               /
#----------------------------------------#
/         Download File Sample           /
#----------------------------------------#
#1- This script may be only used with the#
#   ORIGINAL powered by footer in the    #
#   upload form                          #
#2- This Script may be only used for     #
#   non-commerical porpuses!             #
#3- you may use or modify this script as #
#   you please but do NOT re-distribute  #
#   it                                   #
#----------------------------------------#
#  Copy rights reserved to the author    #
#  Saleh F. Jamal 2004-2005              #
----------------------------------------*/

//you need to know where your SFUConfig.php & functions.php files exist!
require_once('SFUConfig.php');
require_once('functions.php');

//now we include the language file
require_once("$language.lng");

html_header($txt['download']);

echo '<p align="center" class="header">'.$txt['download'].'<br /><span style="font-size: 8pt;">'.$txt['to_download'].'</span></p>';

Downloads(SFU_REALPATH, true, true);

html_footer();
?>
