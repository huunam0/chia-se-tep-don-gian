<table class=thicktable100>
<tr><td>

<center>

<a href="/image.php?fcode={$fcode}" target="_blank"><img src="/thumb.php?fcode={$fcode}" border=0 alt="{$a_filename}"></a>
<br>
<p>{t}File{/t} : {$a_filename}</p>
<p>{t}Size{/t} : {$a_filesize}</p>

<p>{t}Downloaded{/t} : {$a_downloaded} {t}count{/t}</p>
<p>{t}Last downloaded{/t} : {$a_lastdown}</p>

<br>
<p>{t}You can use this link to insert this image to any website or share it{/t}:</p>

<textarea cols=70 rows=2>
http://{$siteurl}/picture.php?fcode={$ufilecode}
</textarea>

<br>

<p>{t}You can use this HTML to insert this image to any website or share it{/t}:</p>

<textarea cols=70 rows=3>
&#60;a href="http://{$siteurl}/picture.php?fcode={$ufilecode}" target=_blank>&#60;img src="http://{$siteurl}/thumb.php?fcode={$ufilecode}" border=0>&#60;/a>
</textarea>
<br>

<form action="download.php" method="get">
<input type="hidden" name="fcode" value="{$fcode}">
<input type="submit" value="{t}Download{/t}">
</form> 


</center> 

</td></tr>
</table>
