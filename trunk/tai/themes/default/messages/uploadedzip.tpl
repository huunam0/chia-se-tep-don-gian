<table class=thicktable100 border=0>
<tr><td align="center">
  <h2>{$fileuploaded}</h2><br>
  <br>
  <p>{t}File{/t}: {$ufilename} </p>
  <p>{t}Size{/t}: {$ufilesize} </p>
  <p>{t}Link to download file{/t}: <a href="{$getfileurl}{$ufilecode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}
  </a></p>
  <p>{t}Link to delete file{/t}: <a href="{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}
  </a></p>

<p>{t}You upload a zip file. If in this file is only pictures in, you can create from it a picture gallery!{/t}</p>

<p><b>{t}Keep in mind, that creating of gallery may take long time, depend of file size and image files count.{/t}</b></p>

<p>{t}If you want create a galery then click this button:{/t}</p>

<form action="gallery.php" id="form" method="get" onsubmit="docstyle=document.getElementById('form').style; docstyle.display='none'; barstyle=document.getElementById('pbar').style; barstyle.display='inline';" style="display: inline;">
  <input type="hidden" name="fcode" value="{$ufilecode}">
  <input name="submit" type="submit" id="upload" value="{t}Create a gallery{/t}">
</form>

</td></tr>
</table>

<div align="center" id="pbar" style="display: none;">

<center>
<br>
{t}Creating gallery. Please wait...{/t}
<br>
</center>

<script type="text/javascript" src="pbar.js"></script>


<script type="text/javascript">
var bar=createBar(400,10,'white',1,'black','blue',45,15,2,'');
</script>

</div>

