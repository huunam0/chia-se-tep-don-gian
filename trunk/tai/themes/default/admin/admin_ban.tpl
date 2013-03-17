<br>
<p><a href="admin.php?a=lout">{t}Logout{/t}</a> | <a href="admin.php">{t}Admin{/t}</a></p>

<table width="100%" border="0">
 <tr bgcolor="#c8c8c8">
 <td>{t}Banned IP{/t}</td> 
 <td>{t}Reason{/t}</td>
 <td>{t}Admin{/t}</td>
 </tr>
{foreach item=item from=$bans}
 <tr bgcolor="#f6f6f6">
 <td>{$item.ip}</td> 
 <td>{$item.reason}</td>
 <td><a href="admin.php?a=ban&ip={$item.ip}&bok=1">{t}Unban IP{/t}</a></td>
 </tr>
{/foreach}
</table>

