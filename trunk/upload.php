<?PHP
/*---------------------------------------#
/     Simplicity oF Upload == Jamal      /
/            Version 1.3.2               /
#----------------------------------------#
/              Main Script               /
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

//include configuration file ..
require_once('SFUConfig.php');
require_once('functions.php');

//check for language overriding..
if (SFU_CHANGE_LNG === true and isset($_GET['language'])) {
   $temp_language = strtolower($_GET['language']);
 //only if file exists, we include it! else we go back to default language
   if (!file_exists("$temp_language.lng")) {
      require_once("$language.lng");
      echo "($temp_language.lng) $txt[lng_doesnot_exist]<br />";
      echo $txt['lng_fall_default'];
   } else {
      $language = $temp_language;
   }
}

//now we include the language file
require_once("$language.lng");

$keys = array_keys($allowed);

//we have to force the only 4 attributes we have..
foreach($keys as $one)
   if (!in_array(strtolower($one), array('image', 'package','docs'))) {
      html_header();
      echo '<p align="center"><span style="color:red; font-size: 12pt;"><b>'.$txt['unknown_attr'].': '.$one.'<br />'.$txt['unknown_notify'].'</b></span></p>';
      html_footer();
      exit;
   }

//check for overriding of the number of files-to-be-uploaded value
if (SFU_CHANGE_NUM === true && isset($_GET['num_files']) && is_numeric($_GET['num_files']))
   $num_files = (int)$_GET['num_files'];

//make a flat array containing allwed extensions ..
//this step is needed to validate the extension before looking at its attribute..
//since we have mulitdimensional array, we need 2 loops to make it flat..
foreach($allowed as $notyet)
   foreach($notyet as $final)
      $flat_allowed[] = strtolower($final);

//start the HTML formation
html_header();

//password protection area..
if (SFU_PROTECT == true) {
   session_start();

   if (isset($_POST['SFU_Protect'])) {
      if ($_POST['SFU_Protect'] == SFU_PASSWORD)
         $_SESSION['SFU_Protect'] = SFU_PASSWORD;
      else {
         echo $txt['pass_wrong'];
         html_footer();
         exit;
      }
   } elseif (!isset($_SESSION['SFU_Protect'])) {
      protectForm();
      html_footer();
      exit;
   } elseif ($_SESSION['SFU_Protect'] !== SFU_PASSWORD) {
      session_unset();
      session_destroy();
   }
}

//if the form is submited, start processing..
//this whole part wont start until user click on "Upload" button..
if (isset($_POST['SFUsubmit'])) {

//start a loop to deal with each file !
   for ($i = 0; $i < $num_files; $i++) {

    //first of all we see if a file was givin to upload or ignore it if empty and continue for the next file!
       if ($_FILES['SFUfile']['name'][$i] == '')
          continue;

    //we filter the filename from unsafe chars ..
       $File = strtr(stripslashes($_FILES['SFUfile']['name'][$i]), '\'" |\\/?!*#', '__________');

    //seperate the extension from the file and store both of them ..
       $dotpos = strrpos($File, '.');
       $length = strlen($File);
       $ext    = strtolower(substr($File, -($length - $dotpos - 1)));
       $noext  = substr($File, 0, -($length - $dotpos - 1));

    //check if the extension is allowed.. but no attribute processing yet!
        if (!in_array($ext, $flat_allowed)) {
           LogErrors("{$txt['extension']} <b>$ext</b> {$txt['not_allowed']}");
           continue;
        }

    //switch php error handler !
        switch($_FILES['SFUfile']['error'][$i]) {
            case 0:
               break;
            case 1:
               LogErrors($txt['PHP_file_size']);
               continue 2;
               break;
            case 2:
               LogErrors("$txt[file_size] $txt[exceded_limit]");
               continue 2;
               break;
            case 3:
               LogErrors($txt['partial_upload']);
               continue 2;
               break;
            case 4:
               LogErrors($txt['no_file']);
               continue 2;
               break;
        }

    //check the file size !
        if ($_FILES['SFUfile']['size'][$i] > (SFU_MAXSIZE * 1024)) {
           LogErrors($txt['file_size'].' ('.round($_FILES['SFUfile']['size'][$i]/1024, 2)." $txt[KB]) {$txt['not_allowed']}");
           continue;
        }

        $fullname = SFU_REALPATH.$File;

    //this part is not important but it's used to initilize $content to avoid a notice!
        if (!isset($content))
           $content = '';

    //check for overwrite option
        if (SFU_OVERWRITE == false or !isset($_POST['SFUoverwrite'])) {
           if (file_exists($fullname)) {
              LogErrors($txt['file_exists']);
              continue;
           }

         //exec files were overwritten before, regardless! this solves the probelm
        }

    //start moving the file ..
        if(@move_uploaded_file($_FILES['SFUfile']['tmp_name'][$i], $fullname)) {
			//file_put_contents($note_file,$_FILES['SFUfile']['name'][$i]."|".$_FILES['SFUfile']['size'][$i]."|".date("d-m-Y")."|".$_POST['SFUtitle'][$i]."\n",FILE_APPEND);
			file_put_contents($note_file,"|".$File."|".$_POST['SFUtitle'][$i]."|\n",FILE_APPEND);
        //start checking the file extension and its attribute!
        //the file name will pushed into an array for status and so goes contents..
            if (isset($allowed['image']) and in_array($ext, $allowed['image']))
               is_image();

         //if the attribute is text ..
            //elseif (isset($allowed['text']) and in_array($ext, $allowed['text']))
               //is_text();

         //this is the dangerous part where we have to be careful with files
            //elseif (isset($allowed['exec']) and in_array($ext, $allowed['exec']))
               //is_exec();

         //otherwise, we just take the file and put it in SFU_REALPATH
            elseif (isset($allowed['package']) and in_array($ext, $allowed['package']))
               $uploaded[] = $File;
			elseif (isset($allowed['docs']) and in_array($ext, $allowed['docs']))
               $uploaded[] = $File;
         //if user asked to change the mode of the uploaded file, we do..
            if ($change_mode == true)
               @chmod($fullname, $mode)or
               LogErrors($txt['chmod_fail']);

    //if we couldn't move the file or file was not uploaded, we generate this error
        } else {
            LogErrors($txt['move_failiur'].'<br />'.$txt['try_again']);
            if (!file_exists(SFU_REALPATH))
               echo '<span style="color:red; font-size: 12pt;"><b>'.$txt['doesnot_exist'].'</b></span><br />';
            elseif (!is_writable(SFU_REALPATH))
               echo '<span style="color:red; font-size: 12pt;"><b>'.$txt['unwritable'].'</b></span><br />';
        }
   }

//if there was any error, we print before content ..
   if ($show_error_log == true and isset($errors) and count($errors) > 0)
      ShowErrorLog($errors);

//count the uploaded files and show them to user!
   if ($show_uploaded_list == true and isset($uploaded) and count($uploaded) > 0)
      ShowUploaded($uploaded);

//finaly, echo content, if any ;)
   if (isset($content))
      echo $content;

   if ($show_upload_form == true)
      PrintForm();

   if ($notify_admin == true)
      MailUploaded();

   if ($log_upload == true)
      FilesLogging();
	
} else
  PrintForm();

//close HTML document
html_footer();

//because we have used some stat functions, it's time to clean the memory
clearstatcache();
?>
