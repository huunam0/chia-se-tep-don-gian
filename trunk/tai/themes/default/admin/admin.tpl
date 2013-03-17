<br>
<p><a href="admin.php?a=lout">{t}Logout{/t}</a> | <a href="admin.php?a=ban">{t}Bans{/t}</a></p> 
<table width="100%" border="0">
 <tr bgcolor="#c8c8c8">
 <td>{t}File name{/t}</td> 
 <td>{t}File size{/t}</td> 
 <td>{t}File IP{/t}</td>
 <td>{t}Downloads count{/t}</td>
 <td>{t}Last download{/t}</td>
 <td>{t}Admin{/t}</td>
 </tr>
{foreach item=item from=$filesinfos}
 <tr bgcolor="#f6f6f6">
 <td><a target=_blank href="info.php?fcode={$item.fcode}">{$item.name}</a></td> 
 <td>{$item.fsize}</td>
 <td>{$item.fip} <a href="admin.php?a=ban&amp;ip={$item.fip}&amp;ok=1">{t}Ban ip{/t}</a></td>
 <td>{$item.fdcnt}</td>
 <td>{$item.fldown}</td>
 <td><a href="info.php?fcode={$item.fcode}&amp;dcode={$item.fdid}">{t}Delete file{/t}</a></td>
 </tr>
{/foreach}
</table>
