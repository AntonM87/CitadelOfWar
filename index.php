<?php
session_start();//запуск общей сессии для пользователя

/* блок header до открывающегося тэга body */
require_once 'view/service_header.php';
/* блок header основной */
require_once 'view/header.php';
/* content */
require_once 'view/content.php';
/////////////////////////////////

/////////////////////////////////
/* mob menu */
require_once 'view/mobmenu.php';
/* cookie */
require_once 'view/coockie.php';
/* footer */
require_once 'view/footer.php';
/* скрипты с закрывающимися тэгами body,html */
require_once 'view/service_footer.php';

//require_once './model/config.php';
