<?php

include "locale/$lang/faq.php";
include "locale/$lang/tos.php";
include "locale/$lang/admin.php";

$smarty->assign('upload',"Загрузить");
$smarty->assign('tos',"Правила");
$smarty->assign('faq',"Ч.А.В.О");
$smarty->assign('admin',"Админ");
$smarty->assign('file',"Файл");
$smarty->assign('size',"Размер");
$smarty->assign('downloaded',"Скачано");
$smarty->assign('count',"раз");
$smarty->assign('last_download',"Скачано в последний раз");
$smarty->assign('upload_y_file',"Загрузите свой файл");
$smarty->assign('upload_instr_1',"1. Нажмите Обзор, выберите свой файл и нажмите Upload!");
$smarty->assign('upload_instr_2',"2. Получите ссылку на скачивание файла и поделитесь ей.");
$smarty->assign('max_file_size',"Максимальный размер загружаемого файла");
$smarty->assign('megs',"мегабайт");
$smarty->assign('file_types_allowed',"Допустимые расширения файлов");
$smarty->assign('uploade',"Закачать!");
$smarty->assign('uploading_wait',"Идет загрузка. Пожалуйста подождите... ");
$smarty->assign('youipbanned'," вам запрещен доступ к этому сайту! Вы были забанены за");
$smarty->assign('filenotallowed',"Данный тип файла запрещен к загрузке!");
$smarty->assign('getfile',"Получить");
$smarty->assign('togetfile',"Чтобы скачать файл введите его номер и нажмите Получить");
$smarty->assign('nofile',"Вы не задали файл для загрузки!");
$smarty->assign('nofilecode',	"Вы не задали номер файла или это неверный номер или код удаления!");
$smarty->assign('delfile',"Удалить");
$smarty->assign('filedeleted',"Файл удален!");
$smarty->assign('fileuploaded',"Файл закачан!");
$smarty->assign('dowloadlink',"Ссылка на скачивание!");
$smarty->assign('deletelink',"Ссылка на удаление файла!");
$smarty->assign('notimeup',"Закачка запрещена! С момента последней загрузки должно пройти $uptimelimit минут!");
$smarty->assign('notimedown',"Скачивание запрещено! С момента последнего скачивания должно пройти $uptimelimit минут!");

?>
