<table class=thicktable100>
<tr><td>

<center>

<p>
{t}File{/t} : {$a_filename}<p>
{t}Size{/t} : {$a_filesize}<p>
{t}Viewed{/t} : {$a_downloaded} {t}count{/t}<p>
{t}Last downloaded{/t} : {$a_lastdown}

<p>
{t}You can now view flv in player bellow{/t}:<p>

<object type="application/x-shockwave-flash" data="uflvplayer_500x375.swf" height="240" width="320">
<param name="bgcolor" value="#FFFFFF" />
<param name="allowFullScreen" value="false" />
<param name="allowScriptAccess" value="always" />
<param name="movie" value="uflvplayer_500x375.swf" />
<param name="FlashVars" value="way=flv.php?fcode={$fcode}&amp;swf=uflvplayer_500x375.swf&amp;w=320&amp;h=240&amp;pic=http://&amp;autoplay=0&amp;tools=1&amp;skin=none&amp;volume=50&amp;q=&amp;comment=" /></object>

<br>
<form action="download.php" method="get">
<input type="hidden" name="fcode" value="{$fcode}">
<input type="submit" value="{t}Download{/t}">
</form> 


</center> 

</td></tr>
</table>
