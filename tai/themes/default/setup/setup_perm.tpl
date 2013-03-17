<h1>{t}Setup file permissions{/t}</h1>

<hr height=1>

| 1 - {t}Introduction{/t} |<b> 2 - {t}Permissions{/t}</b> | 3 - {t}DB Setup{/t} | 4 - {t}Configuration{/t} |  
5 -{t}Installation{/t} | {t}6 - Finish{/t} |   

<hr height=1>
<p>{t}Checking permissions{/t}:</p>
<fieldset>
<p>../data : {$dataperm} 
<p>../thumb : {$thumbperm} 
<p>/cache : {$cacheperm}
<p>config.php : {$configphp}
</fieldset>
<p>
<hr height=1>
{if $isok==1}
<form action=setup.php method=post>
<input type=hidden name=step value=step3>
<input type=hidden name=lng value={$lng}>
<input type=submit value={t}Next{/t}>
<form>
{else}
<form action=setup.php method=post>
<input type=hidden name=step value=step2>
<input type=hidden name=lng value={$lng}>
<input type=submit value={t}Reload{/t}>
<form>
<span class=redstr>{t}Check permissions and click reload to continue{/t}</span>
{/if}


