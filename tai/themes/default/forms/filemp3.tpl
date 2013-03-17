<table class=thicktable100>
<tr><td>

<center>

<p>{t}File{/t} : {$a_filename}</p>
<p>{t}Size{/t} : {$a_filesize}</p>
<p>{t}Listened{/t} : {$a_downloaded} {t}count{/t}</p>
<p>{t}Last downloaded{/t} : {$a_lastdown}</p>

<br>
<p>{t}You can now listen you mp3 in player bellow{/t}:</p>

<object type="application/x-shockwave-flash" data="img/player.swf" width="400" height="25">
    	<param name="movie" value="img/player.swf" />
		<param name="bgcolor" value="#ffffff" />
		<param name="FlashVars" value="mp3=picture.php?fcode={$fcode}&amp;width=400&amp;height=25&amp;volume=25&amp;showstop=1&amp;showinfo=1&amp;showvolume=1&amp;showloading=autohide&amp;bgcolor1=afafaf&amp;bgcolor2=afafaf&amp;loadingcolor=ffffff&amp;buttonovercolor=222222&amp;sliderovercolor=999999" />
	</object>
<br>
<br>
<form action="download.php" method="get">
<input type="hidden" name="fcode" value="{$fcode}">
<input type="submit" value="{t}Download{/t}">
</form> 


</center> 

</td></tr>
</table>
