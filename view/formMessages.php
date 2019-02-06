<?php

$badPassOrLogin = false;

//статус бар с именем пользователя
$userStatusBar = <<<_userStatusBar
<div class="statusAndSettingBar container-fluid">
<div>Мы ждали тебя! $name</div>
<i class="fas fa-user-circle"></i>
<i class="fas fa-cog"></i>
<i class="fas fa-times-circle"></i>
</div>
_userStatusBar;
