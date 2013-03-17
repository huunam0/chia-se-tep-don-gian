<br>
<p><a href="admin.php?a=lout">{t}Logout{/t}</a> | <a href="admin.php">{t}Admin{/t}</a></p>

{$areason}:

<form action=admin.php method=get>
<input type='text' name='reason'>
<input name='ip' type=hidden value='{$iptoban}'>
<input name='a' type=hidden value='ban'>
<input name='ok' type=hidden value='1'>
<input type='submit' value='{t}Ban{/t}'>
</form>

