<table class=thicktable100 border=0>
<tr><td align="center">  
  <h2>{t}Mp3 file uploaded!{/t}</h2>
  <p>{t}File{/t}: {$ufilename} </p>
  <p>{t}Size{/t}: {$ufilesize}</p>
  <p>{t}Link to download file{/t}: <a href="{$getfileurl}{$ufilecode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}
  </a></p>
  <p>{t}Link to delete file{/t}: <a href="{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}
  </a></p>

<p>{t}You can now listen you mp3 in player bellow{/t}:</p>

<object type="application/x-shockwave-flash" data="img/player.swf" width="400" height="25">
    	<param name="movie" value="img/player.swf" />
		<param name="bgcolor" value="#ffffff" />
		<param name="FlashVars" value="mp3=mp3.php?fcode={$ufilecode}&amp;width=400&amp;height=25&amp;volume=25&amp;showstop=1&amp;showinfo=1&amp;showvolume=1&amp;showloading=autohide&amp;bgcolor1=afafaf&amp;bgcolor2=afafaf&amp;loadingcolor=ffffff&amp;buttonovercolor=222222&amp;sliderovercolor=999999" />
	</object>
<p>{t}You can insert this mp3 to any website by using this code:{/t}</p>

<br>
<textarea cols=70 rows=10>
&#60;object type="application/x-shockwave-flash" data="http://{$siteurl}/img/player.swf" width="400" height="25">
  &#60;param name="movie" value="http://{$siteurl}/img/player.swf" />
  &#60;param name="bgcolor" value="#ffffff" />
  &#60;param name="FlashVars" value="mp3=http://{$siteurl}/mp3.php?fcode={$ufilecode}&amp;width=400&amp;height=25&amp;volume=25&amp;showstop=1&amp;showinfo=1&amp;showvolume=1&amp;showloading=autohide&amp;bgcolor1=afafaf&amp;bgcolor2=afafaf&amp;loadingcolor=ffffff&amp;buttonovercolor=222222&amp;sliderovercolor=999999" />
&#60;/object>
</textarea>

<br>

</td></tr>
</table>
