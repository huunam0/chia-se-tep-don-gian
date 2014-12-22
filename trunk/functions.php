<?PHP
/*---------------------------------------#
/     Simplicity oF Upload == Jamal      /
/            Version 1.3.2               /
#----------------------------------------#
/            Functions Script            /
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
//http://basic.gamespot.com.edgesuite.net/action/killzone2/killzone2_ot_ps3_051605_wm.zip
###################################################################
# DO NOT EDIT THESE FUNCTIONS UNLESS YOU KNOW WHAT YOU ARE DOING! #
###################################################################

/*
 *string PrintForm()
 *-Usage: whenever you want print the form, call this function! */
function PrintForm()
{
   global $txt, $num_files, $show_limitions;

  //check if there was any query coming with URL to include it in form action
   if (!empty($_SERVER['QUERY_STRING']))
      $action = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
   else
      $action = $_SERVER['PHP_SELF'];

   if (!is_writable(SFU_REALPATH))
      $disabled = ' disabled="disabled" ';
   else
      $disabled = '';

//start producing the files' fileds, but first open the form..
   $form = '<table width="60%" border="0" align="center" style="border-collapse: collapse;">';

   if (!empty($disabled))
      $form .= '
   <tr>
       <td width="100%" align="'.$txt['align'].'"><span style="color:red; font-size:9pt;"><b>'.$txt['error'].':</b></span></td>
   </tr>
   <tr>
       <td width="100%" align="'.$txt['align'].'"><span style="color:red; font-size:9pt;">'.$txt['pre_unwritable'].'</span></td>
   </tr>';

   $form .= '
   <tr>
      <td width="100%" align="center">
            <form method="post" enctype="multipart/form-data" action="'.$action.'" name="SFUform" onsubmit="return preValidate();">
            <input type="hidden" name="MAX_FILE_SIZE" value="'.SFU_MAXSIZE * 1024 .'" />';

//start the loop ..
   for ($i = 0; $i < $num_files; $i++) {
      $form .= $txt['title'].': <input type="text" name="SFUtitle[]" size="40" '.$disabled.'/><input type="file" name="SFUfile[]" size="20" '.$disabled.'/><br /><br />';
   }

//close form..
   $form .='</td>
   </tr>';

   if (SFU_OVERWRITE == true)
      $form .= '
   <tr>
      <td width="100%" align="'.$txt['align'].'">
      <input type="checkbox" name="SFUoverwrite" value="true" '.$disabled.'/> '.$txt['overwrite'].'
      </td>
   </tr>';

   $form .= '
   <tr>
      <td width="100%" align="'.$txt['align'].'">
        <span style="font-size: 7pt; font-family: tahoma, verdana;">'.($show_limitions == true ? ShowLimits() : '&nbsp;').'</span></td>
   </tr>
   <tr>
      <td align="center">
      
        <input type="submit" value="  '.$txt['submit'].'  " name="SFUsubmit" '.$disabled.'/></td>
   </tr>
    </form>
</table>';

   echo $form;
   echo "<br><a href='index.php'>Xem</a>";
}

/*
string Downloads([string dir_path [,bool show_only_allowed_extension]])
-Usage: this function will list the files existed in the dircroty where it's been executed
-Note: if the first argument $dir was set to a path, the function will list the files found in that path
       if the secodn argument $onlyallowed was set to true, the function will only list the files that thier
       extension have been allowed in SFUConfig.php. if it was set to false it will list all files */
function Downloads($dir = '.', $onlyallowed = true, $add_ext = false) {
  global $txt, $allowed, $highlight_php,$note_file;

  if ($onlyallowed == true) {
    foreach($allowed as $notyet)
      foreach($notyet as $final)
        $flat_allowed[] = strtolower($final);
  }

 //start the table where files are going to be listed..
  echo '
        <table border="1" width="80%" style="border-collapse: collapse;" bordercolor="#000000" align="center">
            <tr>
                <td align="center"><b>'.$txt['filename'].'</b></td>
                <td align="center"><b>'.$txt['fsize'].'</b></td>
                <td  align="center"><b>'.$txt['last_moded'].'</b></td>
            </tr>';
	$file_notes = file_get_contents($note_file);
	//echo $file_notes;
 //open current dir for reading..
  $handle = @opendir($dir);

//now loop through files..
$listfiles= array();
  while (false !== ($file = readdir($handle))) {
    //exclude the dots and SFU's files..
     if ($file != '.' && $file != '..' && $file != 'SFUConfig.php' && !is_dir($file)) {
        if ($onlyallowed == true) {
          $ext = strrchr($file, '.');
          $ext = strtolower(substr($ext, 1));

        //we add new extensions , txt and html, in case exec attribute was used
          if (isset($allowed['exec']) and $add_ext == true) {
             if (!in_array('txt', $flat_allowed)) {
                $flat_allowed[] = 'txt';
                $new_ext = true;
             }

             if($highlight_php == true and !in_array('html', $flat_allowed)) {
                $flat_allowed[]  = 'html';
                $new_ext = true;
             }
          }

          if (!in_array($ext, $flat_allowed))
            continue;
        }
	$listfiles[filemtime($dir.$file)]=$file;
	}
}
krsort($listfiles);
foreach ($listfiles as $file)
	{
      //get file stats
        $info  = stat($dir.$file);
        $stat1 = round($info['size'] / 1024, 0);
        $stat2 = date('j-n-Y H:i:s', $info['mtime']);
		$title=$file;
		$pos = strpos($file_notes,"|$file|");
		if ($pos !== false) {
			$pos += strlen("|$file|");
			$cuoi = strpos($file_notes,"|",$pos);
			if ($cuoi === false) {
				$title = substr($file_notes,$pos);
			}
			else {
				$title = substr($file_notes,$pos,$cuoi-$pos);
			}
		}
		
        echo '
              <tr>
                 <td >';

        echo "<a href='".$dir.$file."'>$title</a></td>\n\t";

        echo '
                 <td  align="center">'.$stat1.' KB</td>
                 <td  align="center">'.$stat2.'</td>
              </tr>';
     }
  
  if ($onlyallowed == true && isset($new_ext))
     echo '
                 <td align="'.$txt['align'].'" colspan="3" class="note" width="100%">'.$txt['new_ext_added'].'</td>
              </tr>';

  echo '
        </table>';
//clear the cache..
  clearstatcache();
}

///////////////////////////////////////////////////////////
/* List of Functions which will deal with uploaded files */
///////////////////////////////////////////////////////////

/* a function to deal with images */
function is_image()
{
   global $uploaded, $content, $File, $show_uploaded_images, $URL;

   $uploaded[] = $File;
 //if user want to show images, we show them ..
   if ($show_uploaded_images == true)
      $content .= "<b>$File</b><br /><img src=\"$URL/$File\" /><br />----------<br />";
}

/* whenever the extension was txt, this function will deal with the file! */
function is_text()
{
   global $txt, $uploaded, $content, $File, $show_uploaded, $fullname;

 //save the file name, to show it at the end..
   $uploaded[] = $File;

 //wanna show file content?! this IF statment shall fulfill your request.
   if ($show_uploaded == true) {
      $fp = fopen($fullname, 'rb')or
      LogErrors($txt['read_file'], true);

      $read = fread($fp, filesize($fullname));

      fclose($fp);

      $content .= "<b>$File</b><br />".nl2br(htmlspecialchars($read)).'<br />----------<br />';
   }
}

/* this function will deal with the "exec" attribute */
function is_exec()
{
  global $txt, $ext, $uploaded, $content, $File, $show_uploaded;
  global $highlight_php, $fullname, $noext, $fullname;

     $unsafe = $fullname;
  //we open the file for reading ..
     $fp = fopen($fullname, 'rb')or
     LogErrors($txt['read_file'], true);

     $EXECcontent = fread($fp, filesize($fullname));
     fclose($fp);

  //we check here if user wants to highlight the code or not !
    if ($ext == 'php' and $highlight_php == true)
       highlightPHP($EXECcontent);

  //we don't need to highlight the file
    else {

  //create a text file..
       $fp = fopen(SFU_REALPATH.$noext.'txt', 'wb')or
       LogErrors($txt['write_file'], true);

    //write to file..
       fwrite($fp, $EXECcontent)or
       LogErrors($txt['write_file'], true);

    //and finally close file..
       fclose($fp);

    //we re-assign this variable just in case the user wanted to chmod() the file..
       $fullname = SFU_REALPATH.$noext.'txt';
       $uploaded[] = $noext.'txt';

   //if user wants to show content..
       if ($show_uploaded == true)
           $content .= "<b>$noext"."txt</b><br />".nl2br(htmlspecialchars($EXECcontent)).'<br />----------<br />';
    }
   //and finally delete the executable file ..
       unlink($unsafe);
}

/**
 * @return void
 * @param unsafecontent string
 * @desc give php code and it will be highlighted and saved into an HTML file
 */
function highlightPHP($unsafecontent)
{
  global $txt, $uploaded, $content, $show_uploaded, $noext;

 //then we highlight the code..
   $safePHP = highlight_string($unsafecontent, TRUE);

 //then we create a new file and dump the highlighted code into it..
   $fp = fopen(SFU_REALPATH.$noext.'html', 'wb')or
   LogErrors($txt['read_file'], true);

   fwrite($fp, $safePHP)or
   LogErrors($txt['write_file'], true);

   fclose($fp);

   $uploaded[] = $noext.'html';

 //if user wants to show content..
   if ($show_uploaded == true)
     $content .= "<b>$noext"."html</b><br />".$safePHP.'<br />----------<br />';
}

/* this function will show the errors happened, if any! */
function ShowErrorLog($errors)
{
   global $txt;

   echo '<span style="color: red;"><u><b>'.$txt['error_log'].":</b></u></span><br />\n";

 //we print all errors we found..
   foreach($errors as $file => $message)
      echo "-$file: $message.<br />\n";

   echo "<br /><u>{$txt['limits']}:</u><br />\n";
   echo ShowLimits();
}

/**
 * @return string
 * @param null
 * @desc will show the maximum file size and allowed extensions
*/
function ShowLimits()
{
   global $flat_allowed, $txt;
   //we show upload limits for user so he can avoid it..
   $exts = implode(', ', $flat_allowed);

   if (SFU_MAXSIZE > 1024)
      $maximum = round((SFU_MAXSIZE / 1024), 2) . ' '.$txt['MB'];
   else
      $maximum = SFU_MAXSIZE .' '.$txt['KB'];

   return "<b>{$txt['max_size']}</b>: $maximum<br />
   <b>{$txt['allowed_ext']}</b>: $exts.<br />";
}

/* to list the uploaded files, pass the array containing the names .. */
function ShowUploaded($uploaded)
{
   global $txt;

   echo '<br /><a href="index.php" style="color: green;"><b>' .count($uploaded). '</b> '.$txt['succes'].":</a><br />\n";
 //print all ,succefully, uploaded files!
	echo "<ol>";
   foreach($uploaded as $succes)
      echo"<li>$succes</li>\n";

   echo '</ol><hr />';
}

/* logging upload to a file */
function FilesLogging() {
   global $uploaded, $errors, $txt, $log_path;

   $uploader = $_SERVER['REMOTE_ADDR'];
   $fp = @fopen("$log_path/$uploader.txt", 'ab');

   if (!$fp)
      echo '<span style="color:red; font-size: 12pt;"><b>'.$txt['log_failed'].'</b></span><br />';
   else {
      $content = '';
      if (isset($uploaded)) {
         foreach($uploaded as $file)
            $content.= $txt['log']['succeded'].date('d-m-Y H:i').">$file\n";
      }
      if (isset($errors)) {
         foreach($errors as $file => $error)
            $content.= $txt['log']['failed'].date('d-m-Y H:i').">$file: $error\n";
      }

      @fwrite($fp, $content);/*or
      print('<span style="color:red; font-size: 12pt;"><b>'.$txt['log_write_failed'].'</b></span><br />');*/

      fclose($fp);
   }
}

/* a mailer function that will email details about any uploading attempts */
function MailUploaded() {
   global $txt, $uploaded, $errors, $admin_email, $URL;

  //we put an introduction and the IP address of the user who attempted to upload
   $message = $txt['mail']['head'];
   $message.= "$_SERVER[REMOTE_ADDR]\n\n";

  //any succesful upload?
   if (isset($uploaded)) {
      $message.= $txt['mail']['succeded'];
      foreach($uploaded as $file)
         $message.= "$URL/$file\n";
   }

  //or is it errors ?
   if (isset($errors)) {
      $message.= $txt['mail']['failed'];
      foreach($errors as $file => $error)
         $message.= "$file: $error\n";
   }

   $message.= $txt['mail']['conc'];

   @mail($admin_email, $txt['mail']['subject'], $message, "FROM: $admin_email");
}

/*
string protectForm()
-Usage: this function will print a form requesting the universal password */
function protectForm() {
   global $txt;

   if (!empty($_SERVER['QUERY_STRING']))
      $action = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
   else
      $action = $_SERVER['PHP_SELF'];

   echo '<form method="post" action="'.$action.'">
   <table width="35%" border="1" align="center" style="border-collapse: collapse;">
      <tr>
         <td align="center" colspan="2"><span style="font-size:12pt;"><b>'.$txt['pass_uni'].'</b></span></td>
      </tr>
      <tr>
         <td align="'.$txt['align'].'" colspan="2">'.$txt['pass_intro'].'</td>
      </tr>
      <tr>
         <td align="'.$txt['align'].'" width="20%"><b>'.$txt['password'].'</b>:</td>
         <td align="'.$txt['align'].'" width="80%"><input type="password" size="35" name="SFU_Protect" /></td>
      </tr>
      <tr>
         <td align="center" colspan="2">
         <input type="submit" name="SFU_Submit_Pass" value="'.$txt['pass_submit'].'" /></td>
      </tr>
   </table>
</form>';
}

/*
void LogErrors (string Error_message [,bool delete_uploaded_file])
-Usage: a function to log errors
        this function will not kill the script, instead it will log errors and then after all files
        will being processed the log will be displayed .. */
function LogErrors($message, $delete = false)
{
   global $errors, $File, $fullname;

   $errors[$File] = $message;

 //if we want to delete the file then we do ..
   if ($delete == true)
      unlink($fullname);
}

#//  DO NOT CHANGE THESE CONSTANTS  //#
#//   IT IS ILLEGAL TO EDIT THEM    //#
define('NAME', 'THPT Nguyễn Du');
define('VERSION', '2014');
define('SCRIPT', NAME.' '.VERSION);
#//  DO NOT CHANGE THESE CONSTANTS  //#
#//   IT IS ILLEGAL TO EDIT THEM    //#
?>
