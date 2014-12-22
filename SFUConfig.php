<?PHP
/*---------------------------------------#
/     Simplicity oF Upload == Jamal      /
/            Version 1.3.2               /
#----------------------------------------#
/           Configuration File           /
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
/*   Language   */
//specify which language you want to use.. however you can override the language selected (if enabled ONLY)
//by passing a query in your url to language variable like this: upload.php?language=arabic
$language = 'vietnamese';

//allow users to change the language via URL Query ?
//TRUE for yes, FALSE for no
//Note: setting this to FALSE is recommended
define('SFU_CHANGE_LNG', false);

/*    File Destination    */
//here you must specify the real path of the directory where you want to upload
//your files to! use the trailing slash as in the exmaple..
//most of the time, the default value of this constant is what you need.
//if you don't know how to get the real path, run the file realpath.php in the upload dir
//and get the output and put here.
//note: this constant IS NOT AND MUST NOT contain a URL!!
define('SFU_REALPATH', 'files/'); //THIS IS AN EXAMPLE


//URL which leads to the uplaod directory WITHOUT trailing slash like in the example below:
$URL = 'http://localhost/sfu/files';

/*    HTML your Script    */
/*if you want to format your script with HTML, then set this variable's value to TRUE
//and then you can edit the functions html_header() and html_footer() to the design you want.
//NOTE: if you are using this script inside your website and not as standalone, put the value
//      of this variable to FALSE */
$format_script = true;

/*  Number of File Upload Fields  */
//this value can be overridin by passing the value wanted in a url query (if enabled ONLY)
//in the page that contains the form like this for example: upload.php?num_files=5
//so the pattern is: FILE_WITH_UPLOAD_FORM_IN_IT.php?num_files=NUMBER_HERE
$num_files = 5;
$note_file = "files.txt";
//enable visitors to change the number of files to upload via URL query?
//TRUE for yes, FALSE for no ..
define('SFU_CHANGE_NUM', false);

/*    File Size    */
//specify the maximum size of the file in KiloBytes.
define('SFU_MAXSIZE', 4096);

/*    Overwrite    */
//do you want files with the same names to overwrite exisiting files?
//TRUE for yes, FALSE for no ..
define('SFU_OVERWRITE', true);

/*    Show Limitions in the Upload Form   */
//do you want to show the limitions of the upload at the bottom of the form?
//true for yes, false for no ..
$show_limitions = true;

/*  Upload logging  */
//if you want to log iformation about the uploader and what s/he uploaded set this
//true for logging, or false for no.
$log_upload = false;

//if you enabled logging, you have to create a dirctory anywhere and put its
//real path in this variable:
$log_path = 'E:\\www\\sfu';
//NOTE: you have to change the mode of the log dir to 777 in order to allow files to be created!

/*   Notification   */
//do you want an email notification to be sent to you when someone tries to upload file(s)?
//TRUE for yes, FALSE for no
$notify_admin = false;

//if you chose to notify yourself, provide an email address
$admin_email = 'email@provider.com';

/*  Upload Protection  */
//do you want to protect the upload form with a universal password?
//TRUE for yes, FALSE for no
define('SFU_PROTECT', false);

//what is the password you want to set?
//use alphanumric characters ONLY!
define('SFU_PASSWORD', '12345');

/*    Allowed Extensions    */
/*specify the allowed extensions that can be uploaded and how they will be
treated with attributes.. for example the attribute image will take pictures and
display them in HTML's img tag, some files may be risky to upload so you can set the
attribute 'exec' so they will be renamed into txt files so they wont be excuted ..
to disable an allowed extension simple add a hash before it like:
#$allowed['exec'][] = 'asp';
to add new extensions just add them with the attribute you want in the pattern:
$allowed['ATTRIBUTE'][] = 'EXTENSION';
            WITH OUT A DOT!
//the rest of the attributes is below */

###################################
/* IMPORTANT IMPORTANT IMPORTANT */
###################################

/* USE LOWER CASE ONLY FOR ALL EXTENSIONS YOU WANT TO ALLOW */

#    Attributes List   #
# =====================#
/*-image:   will treat file as an image and will be displayed if allowed!
  -text :   these files will not be touched at all and their contents wont be checked, so
            becareful when you use this one.
  -exec :   these files (like php, asp, cgi ..etc) may contain harmful codes
            that may harm your server so their content will be converted into safe-plain text
            and saved into a new .txt file.
  -package: this attribute allows you to upload files like zip, rar, exe and files which do not
            belong to previous attributes.. before, files like zip could be uploaded with
            the text attribut but you had to disable "view uploaded files" so you don't see
            weird results! now with this attribute the file wont be displayed even if you
            enabled "view uploaded file".*/
#  End of Attributes List  #
$allowed['image'][] = 'gif';
$allowed['image'][] = 'jpg';
$allowed['image'][] = 'png';

//$allowed['text'][] = 'txt';

//$allowed['exec'][] = 'php';
//$allowed['exec'][] = 'asp';
//$allowed['exec'][] = 'cgi';

$allowed['package'][] = 'zip';
$allowed['package'][] = 'mp3';
$allowed['package'][] = 'rar';

$allowed['docs'][] = 'pdf';
$allowed['docs'][] = 'xls';
$allowed['docs'][] = 'doc';

//when files are uploaded successfully, do you want to show the list of names for the
//uploaded files ?
//TRUE for yes, FALSE for no..
$show_uploaded_list = true;

//if any errors occur, do you want to show the error log? (the log is friendly formatted)
//TRUE for yes (HIGHLY RECOMMENDED), FALSE for no (NOT RECOMMENDED AT ALL)..
$show_error_log = true;

//after the files are uploaded succesfully, do you want to show the upload form again!
//TRUE for yes, FALSE for no..
$show_upload_form = true;

//do you want to show the content of uploaded files under "text" attribute after they
//are uploaded?
//TRUE for yes, FALSE for no..
$show_uploaded = true;

//do you want to show images after they have been uplaoded ?
//TRUE for yes, FALSE for no..
$show_uploaded_images = true;

//do you want php files to be highlighted ?
//TRUE for yes, FALSE for no ..
//Note: if you enable this feature, the highlited file size might increase up to x5 times!!
//a php file with 44 kb as original size truned into 222 kb html file when I was testing the script!!
$highlight_php = true;

//do you want to change the mode of the uploaded files?
//TRUE for yes, FALSE for no.
//Note: this is useless in a Windows server ..
$change_mode = false;

//if you chose to allow chmoding the uploaded file, then set the mode you want here
//you need to lead the mode number with a zero like 0644 (octal value)..
$mode = 0777;

/*   HTML Functions Definations   */
/*
html_header ([string Page_title])
-Usage: this function will allow you to run this script as standalone and formatted script.
-Note: this function will not apply any formation on the script unless you enable the $format_script
       variable in this file above and set its value to TRUE ..*/
function html_header($title = SCRIPT)
{
   global $format_script, $txt;

   if ($format_script == true)
      echo'<html dir="'.$txt['htmldir'].'">
    <head>
        <title>'.$title.'</title>
        <meta http-equiv="Content-Type" content="text/html; charset='.$txt['charset'].';" />
        <meta name="description" content="'.$title.'" />
		<meta name="author" content="Tran Huu Nam - thnam@thptnguyendu.edu.vn" />
        <style type="text/css">
        <!--
        body {
           font-family: Tahoma, verdana; font-size: 15px;
        }
        p.header {
           font-size: 20px;
        }
           a:link, a:visited {
           color: #009999; text-decoration:none;
        }
        a:active {
            color: #FF6600; text-decoration:none;
        }
        td {
            font-size:15px;
        }
        td.note {
            font-size:12px;
        }
         -->
        </style>
    </head>
  <body>
 <p align="center" class="header">'.SCRIPT.'</p>';
}

/*
html_footer()
-Usage: this function is only used to close the HTML documnet and all the opened tags (currently Body & html)
-Note: this function will not work unless the value of $format_script in this file is TRUE. */
function html_footer()
{
   global $format_script;

   if ($format_script == true)
      echo '
           <p align="center"><span style="font-size: 8pt;"><b>Powered By:</b> '.SCRIPT.'<br />
        </span></p>
    </body>
</html>';
}
?>
