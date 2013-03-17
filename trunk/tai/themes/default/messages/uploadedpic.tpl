<table class=thicktable100 border=0>
<tr><td align="center">
  <h2>{$fileuploaded}</h2>
  <br>
	<a href="/image.php?fcode={$ufilecode}" target=_blank><img src="/thumb.php?fcode={$ufilecode}" border=0 alt="{$ufilename}"></a>
  <br>
  <p>{t}File{/t}: {$ufilename} </p>
  <p>{t}Size{/t}: {$ufilesize} </p>
  <p>{t}Link to download file{/t}: <a href="{$getfileurl}{$ufilecode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}
  </a></p>
  <p>{t}Link to delete file{/t}: <a href="{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}
  </a></p>

<br>
<p>{t}You can use this link to insert this image to any website or share it{/t}:</p>

<textarea cols=70 rows=2>
http://{$siteurl}/picture.php?fcode={$ufilecode}
</textarea>

<br>

<p>{t}You can use this HTML to insert this image to any website or share it{/t}:</p>

<textarea cols=70 rows=3>
&#60;a href=http://{$siteurl}/picture.php?fcode={$ufilecode} target=_blank>&#60;img src="http://{$siteurl}/thumb.php?fcode={$ufilecode}" border="0" alt="{$ufilename}">&#60;/a>
</textarea>
<br>

</td></tr>
</table>
