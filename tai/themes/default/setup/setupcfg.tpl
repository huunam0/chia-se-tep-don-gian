<h1>{t}Configuration setup{/t}</h1>

<hr height=1>
| 1 - {t}Introduction{/t} | 2 - {t}Permissions{/t} | 3 - {t}DB Setup{/t} | <b>4 - {t}Configuration{/t}</b> |  5 - {t}Installation{/t} | {t}6 - Finish{/t} |   
<hr height=1>

{if $isok==0}
<form name=mysql action="setup.php?step=step4"  method=post>
<fieldset>
<label>{t}Site Name{/t}</label>&nbsp;&nbsp;<input name=sitename value="PHP Open FileShare" type=text><p>
<label>{t}Site URL (full path without 'http://' or ending '/'){/t}</label>&nbsp;&nbsp;<input name=siteurl value="{$hosturl}" type=text><p>
<hr height=1>
<label>{t}Admin password{/t}</label>&nbsp;&nbsp;<input name=apass value="admin" type=text><p>
<hr height=1>
<label>{t}Time limit between file upload (in minutes){/t}</label>&nbsp;&nbsp;<input name=uplim value="5" type=text><p>
<label>{t}Time limit between file download (in minutes){/t}</label>&nbsp;&nbsp;<input name=dnlim value="5" type=text><p>
<label>{t}File auto deleted after (days){/t}</label>&nbsp;&nbsp;<input name=adel value="7" type=text><p>
<label>{t}Allowed file types{/t}</label>&nbsp;&nbsp;<input size=100 name=filetypes value="zip,rar,jpg,gif,jpeg,avi,png,mpg,mp4,mov,mp3,flv" type=text><p>
<hr height=1>
<label>{t}Language (ru_RU, en_US and etc){/t}</label>&nbsp;&nbsp;<input name=lang value="ru_RU" type=text>
<hr height=1>
<label>{t}Use mod_rewrite (true - yes, false - No){/t}</label>&nbsp;&nbsp;<input name=modrew value="true" type=text>
</fieldset>
<p>
<input name=save type=hidden value=ok>
<input type=hidden name=lng value={$lng}>
<input name=go type=submit value={t}Save{/t}>
</form>
{else}
<form name=mysql action="setup.php?step=step5"  method=post>
{t}Configuration created{/t}!<p>
<input type=hidden name=lng value={$lng}>
<input name=go type=submit value={t}Next{/t}>
</form>
{/if}

