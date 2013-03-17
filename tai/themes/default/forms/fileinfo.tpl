<table class=thicktable100>
<tr><td>

<center>

<p>{t}File{/t} : {$a_filename}</p>
<p>{t}Size{/t} : {$a_filesize}</p>

<p>{t}Downloaded{/t} : {$a_downloaded} {t}count{/t}</p>
<p>{t}Last downloaded{/t} : {$a_lastdown}</p>

<br>
<div id="chodoi">Please wait</div>
<div id="taive" style="display:none;">
<form action="download.php" method="get">
<input type="hidden" name="fcode" value="{$fcode}">
<input type="submit" value="{t}Download{/t}">
</form> 
</div>

</center> 

</td></tr>
</table>
