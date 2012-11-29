<?php
require_once "config.php";
$link = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name);
mysql_query("SET NAMES utf8"); //connect in decode utf8
//define("DEBUG",TRUE);
?>
<html><head><title>File sharing</title>
<script type='text/javascript' src='jquery-min.js'></script>
<script type='text/javascript'>
var t=20;
function dem(){
	if (t>0) {
		t--;
		$('#chodoi').html("Waiting for "+t+" second(s)");
		setTimeout(dem,1000);
	} else {
		$('#chodoi').hide();
		$('#taive').html('<a href="'+url+'">Download</a>');
	}
}
$(document).ready(function(){
	dem();
});
</script>
</head><body>
<?php
if (isset($_GET['f'])) {
	$sql="select * from danhmuc where ma='".$_GET['f']."' limit 1";
	$ret=mysql_query($sql) or die("Error in query");
	if ($row=mysql_fetch_array($ret)) {
		ghinhatki($row['id']);
		echo "<script type='text/javascript'>var url='".$row['tep']."'</script>";
		echo "<div id='chodoi'></div><div id='taive'>Download</div>";
	} else {
		echo "File not found.";
	}
} else {
	echo "Welcome to our site.";
}
echo "</body></html>";

function uploadFile($uname,$folder,$debug=false) {
	if ($debug) print_r($_FILES);
	if (!empty($_FILES[$uname])) {
		if (is_uploaded_file($_FILES[$uname]["tmp_name"])){
			if ($_FILES[$uname]["error"] > 0)  {
				if ($debug) echo "Upload MP3 with error : " . $_FILES[$uname]["error"] . "<br />";
				return "";
			} else {
				if ($debug) echo "Upload: " . $_FILES[$uname]["name"] . "<br />";
				if ($debug) echo "Type: " . $_FILES[$uname]["type"] . "<br />";
				if ($debug) echo "Size: " . ($_FILES[$uname]["size"] / 1024) . " Kb<br />";
				if ($debug) echo "Temp file: " . $_FILES[$uname]["tmp_name"] . "<br />";
				$filename = $_FILES[$uname]["name"];
				$i=1;
				while (file_exists($folder. "/".$filename)) {
					$filename = $i++ ."_". $_FILES[$uname]["name"];    
				}
				move_uploaded_file($_FILES[$uname]["tmp_name"], $folder. "/" . $filename);
				return $filename;
			}
		} else {
			if ($debug) echo "Upload Fail";
			return "";
		}
	}
	if ($debug) echo "Not found";
	return "";
}


function redirect($location, $delaytime = 0) {
    if ($delaytime>0) {    
        header( "refresh: $delaytime; url='".str_replace("&amp;", "&", $location)."'" );
    } else {
        header("Location: ".str_replace("&amp;", "&", $location));
    }    
}
function ghinhatki($tep) {
	mysql_query("insert into nhatki (tep,ip,luc) value ($tep,'".$_SERVER['REMOTE_ADDR']."',NOW())");
}
?>
