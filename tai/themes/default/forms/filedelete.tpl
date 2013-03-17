<table class=thicktable100>
<tr><td>

<center>

<p>{t}File{/t} : {$a_filename}</p>
<p>{t}Size{/t} : {$a_filesize}</p>
<p>{t}Downloaded{/t} : {$a_downloaded} {t}count{/t}</p>
<p>{t}Last downloaded{/t} : {$a_lastdown}</p>

<br>
<form action="delete.php" method="get">
<input type="hidden" name="fcode" value="{$fcode}">
<input type="hidden" name="dcode" value="{$dcode}">
<input type="submit" value="{t}Delete file{/t}">
</form> 


</center> 

</td></tr>
</table>
