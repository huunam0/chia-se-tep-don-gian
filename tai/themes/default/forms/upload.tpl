<table class=thicktable100>
<tr><td align="center" >
<br>
<h2>{$sitename}</h2>


{t}Upload you file{/t}<br>
<p>{t}1. Press Browse and select file to upload and press Upload!{/t}</p>
<p>{t}2. Get link and share it with friends{/t}</p>
<p>{t}You can upload files with size up to{/t} {$maxfilesize} {t}megs{/t}!</p>

<form enctype="multipart/form-data" action="upload.php" id="form" method="post" onsubmit="docstyle=document.getElementById('form').style; docstyle.display='none'; barstyle=document.getElementById('pbar').style; barstyle.display='inline';" style="display: inline;">
  <input type="hidden" name="p" value="upload">
  <input type="file" name="upfile" size="60">
  <input name="submit" type="submit" id="upload" value="{t}Upload!{/t}">
</form>

<p>
{t}Allowed file types for upload:{/t} {$allowedfiletypes}
</p>
</td></tr>
</table>

<div id="pbar" align="center" style="display: none;">

<br>
<center>{t}Uploading! Please wait...{/t}</center>
<br>

<script type="text/javascript" src="pbar.js"></script>


<script type="text/javascript">
var bar=createBar(400,10,'white',1,'black','blue',45,15,2,'');
</script>

</div>

