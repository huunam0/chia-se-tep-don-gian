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

function DeleteFileFromDB($mydb, $fcode)
{ 
  $res = $mydb->Query("delete from files WHERE file_code = '$fcode'");
  echo mysql_error();
  return $code;	
}

function CheckDeleteId($mydb, $dcode)
{
  $res = $mydb->Query("SELECT * FROM files where delete_id='$dcode'");
  
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
