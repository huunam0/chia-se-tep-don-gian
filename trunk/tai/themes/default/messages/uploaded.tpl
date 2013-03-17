<table class=thicktable100>
<tr><td align="center">
  <h2>{t}File uploaded{/t}</h2>
  <br>
  <p>{t}File{/t}: {$ufilename} </p>
  <p>{t}Size{/t}: {$ufilesize} </p>
  <p>{t}Link to download file{/t}: <a href="{$getfileurl}{$ufilecode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}
  </a></p>
  <p>{t}Link to delete file{/t}: <a href="{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}">
    http://{$siteurl}{$getfileurl}{$ufilecode}&amp;dcode={$ufiledcode}
  </a></p>
	
</td></tr>
</table>
