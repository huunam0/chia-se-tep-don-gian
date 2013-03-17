<h1>{t}Installing database{/t}</h1>

<hr height=1>
| 1 - Introduction | 2 - Permissions | 3 - DB Setup | 4 - Configuration |<b>  5 - Installation</b> | 6 - Finish |   
<hr height=1>

{$instprogr}

<form name=mysql action="setup.php?step=step6"  method=post>
<b><span class=greenstr>{t}All seems ok{/t}!</span></b><p>
<input type=hidden name=lng value={$lng}>
<input name=go type=submit value={t}Next{/t}>
</form>

