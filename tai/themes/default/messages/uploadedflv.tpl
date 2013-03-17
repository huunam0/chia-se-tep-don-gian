<table class=thicktable100 border=0>
<tr><td align="center">
  <h2>{t}Flv file uploaded!{/t}</h2>
  <br>
  <p>{t}File{/t}: {$ufilename}</p>
  <p>{t}Size{/t}: {$ufilesize} </p>
  <p>{t}Link to download file{/t}: <a href="{$getfileurl}{$ufilecode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}
  </a></p>
  <p>{t}Link to delete file{/t}: <a href="{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}
  </a></p>

<br>
<p>{t}You can now view flv in player bellow{/t}:</p>
<object type="application/x-shockwave-flash" data="uflvplayer_500x375.swf" height="240" width="320">
<param name="bgcolor" value="#FFFFFF" />
<param name="allowFullScreen" value="false" />
<param name="allowScriptAccess" value="always" />
<param name="movie" value="uflvplayer_500x375.swf" />
<param name="FlashVars" value="way=flv.php?fcode={$ufilecode}&amp;swf=uflvplayer_500x375.swf&amp;w=320&amp;h=240&amp;pic=http://&amp;autoplay=0&amp;tools=1&amp;skin=none&amp;volume=50&amp;q=&amp;comment=" /></object>

<br>
<p>{t}You can now use link bellow to insert flv file to any flash flv player{/t}:</p>
    http://{$siteurl}/flv.php?fcode={$ufilecode}
    
<br>
</td></tr>
</table>
