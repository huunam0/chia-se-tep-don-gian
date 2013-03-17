<h1>{t}Welcome to setup{/t}</h>

<h3>{t}This installer help you setup PHP Open FileShare!{/t}</h3>
<hr height=1>
| <b>1 - {t}Introduction{/t}</b> | 2 - {t}Permissions{/t} | 3 - {t}DB Setup{/t} | 4 - {t}Configuration{/t} |  
5 -{t}Installation{/t} | {t}6 - Finish{/t} |   
<hr height=1>
<p>{t}PHP Open FileShare present to you service like rapidshare, megaupload and etc.{/t}</p>
<hr height=1>
<p><b>{t}Requarements{/t}:</b></p>
<p>- {t}Apache >= 2.2.0 server with php and mysql{/t}</p>
<p>- {t}PHP >= 5.2.0 with mysql{/t}</p>
<p>- {t}MYSQL >= 5.0.0{/t}</p>
<p>- {t}You hosting must allow to write files to disk by scripts{/t}</p>
<hr height=1>
<b>{t}You must set permission to folders{/t}:</b>
<p>../data - 777 - <b>{t}NOTE:{/t}</b> <u>data</u> {t}folder must be outside document folder of you web server{/t}</p>
<p>../thumb - 777 - <b>{t}NOTE:{/t}</b> <u>thumb</u> {t}folder must be outside document folder of you web server{/t}</p>
<p>/cache - 777</p>
<p>setup.php - 666</p>
<hr height=1>
<form action=setup.php method="get">
<input type=hidden name=step value=step2>
<input type=hidden name=lng value={$lng}>
<input type=submit value="{t}Next{/t}">
<form>


