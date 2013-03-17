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
	if (t>1) {
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
		echo "<div id='filename'>".$row['ten']." - ".$row['tacgia']."</div>";
		echo "<div id='chodoi'></div><div id='taive'>Download</div>";
	} else {
		echo "File not found.";
	}
} else {
	echo "Welcome to our site.";
}
echo "</body></html>";



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
