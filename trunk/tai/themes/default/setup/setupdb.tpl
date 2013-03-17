<h1>{t}MySQL database setup{/t}</h1>

<hr height=1>
| 1 - {t}Introduction{/t} | 2 - {t}Permissions{/t} |<b> 3 - {t}DB Setup{/t} </b>| 4 - {t}Configuration{/t} |  
5 -{t}Installation{/t} | {t}6 - Finish{/t} |   

<hr height=1>

{if $isok==0}
<h4>{t}1. Configure you mysql database{/t}</h4>
<form name=mysql action="setup.php?step=step3"  method=post>
<input type=hidden name=lng value={$lng}>
<fieldset>
<label>{t}Host name{/t}</label>&nbsp;&nbsp;<input name=host value=localhost type=text><p>
<label>{t}DB name{/t}</label>&nbsp;&nbsp;<input name=db value=phpofs type=text><p>
<label>{t}User name{/t}</label>&nbsp;&nbsp;<input name=uname value="" type=text><p>
<label>{t}User password{/t}</label>&nbsp;&nbsp;<input name=pass value="" type=password><p>
<label>{t}Table prefix{/t}</label>&nbsp;&nbsp;<input name=pref value="phpofs_" type=text><p>
</fieldset>
<input name=go type=submit value=Check>
</form>
{else}
<form name=mysql action="setup.php?step=step4"  method=post>
<b><span class=greenstr>{t}All seems ok{/t}!</span></b><p>
<input type=hidden name=lng value={$lng}>
<input name=go type=submit value={t}Next{/t}>
</form>
{/if}
{if $iserr==0}
Error: <span class=redstr><b>{$error}</b></span>
{/if}

