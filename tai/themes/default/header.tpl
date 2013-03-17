<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
<title>{$sitename}</title>
<meta http-equiv="content-type" content="text/html; charset={$charset}">
<meta http-equiv="content-language" content="en">
<meta name="rating" content="general">
<meta name="robots" content="index, follow">
<meta name="keywords" content="chamthi, chia se, tai nguyen, tai lieu,tu lieu">
<meta name="description" content="Php Open FileShare site">
<meta name="revisit-after" content="7 days">

<link href="/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="jquery-min.js"> </script>
<script type="text/javascript">
var t=20;
function dem(){
	if (t>1) {
		t--;
		$('#chodoi').html("Waiting for "+t+" second(s)");
		setTimeout(dem,1000);
	} else {
		$('#chodoi').hide();
		$('#taive').show();
	}
}
$(document).ready(function(){
	dem();
});
</script>

</head>

<body>

<script type="text/javascript">

if (self != top) 
{ldelim} 
  top.location.replace(window.location.href) 
{rdelim}

</script>

{include file='main_menu.tpl'}
