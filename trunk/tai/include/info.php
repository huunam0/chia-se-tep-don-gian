<?php
/*
===============================================================================
=     Php Open FileSharing
=
=     Copyright (c) 2007 Vasiliy Altunin
=     http://phpofs.sf.net
=     skyr@users.sourceforge.net
=
=     Released under the terms and conditions of the
=     GNU General Public License (http://gnu.org).
=
===============================================================================
*/


function CheckDownloadId($mydb, $fcode)
{
  $res = $mydb->Query("SELECT * FROM files where file_code='$fcode'");
  
  if (mysql_num_rows($res)==0)
  {
    return false;
  }
  else
  {
    return true;  
  }
}

?>
