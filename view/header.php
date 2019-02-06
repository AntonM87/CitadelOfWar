<div class="main-link-logo">
    <a href="../index.php">
        <img src="../img/warhammer-40000-logo.png" alt="">
    </a>
</div>
<nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="../index.php">
        <img src="../img/warhammer-40000-logo.png" class="img-fluid" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Новости</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Материалы</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">База знаний</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Статьи</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Форум</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Барахолка</a>
            </li>
            <li data-tooltip="Вход/Регистрация" id="enterReg" class="nav-item active">
                <i id="enterReg" class="fas fa-door-open"></i>
            </li>
        </ul>
    </div>
    <form class="form-inline">
        <input class="form-control" type="search" placeholder="Поиск по сайту" aria-label="Search">
        <button class="navbar-toggler" type="submit"><i class="fas fa-search"></i></button>
        <button id="mobMenuToggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i id="mobMenuToggler" class="fas fa-bars"></i>
        </button>
        <span id="enterReg" class="enter navbar-toggler">
            <i id="enterReg" class="fas fa-door-open"></i>
        </span>
    </form>

</nav>

<!--<div class="statusAndSettingBar container-fluid">-->
<!--    <div>Мы ждали тебя! --><?php //echo $name ?><!--</div>-->
<!--    <i class="fas fa-user-circle"></i>-->
<!--    <i class="fas fa-cog"></i>-->
<!--    <i name="exit" class="fas fa-times-circle"></i>-->
<!--</div>-->


<!--<form style="display: none" data-visible="false" role="auth" id="authForm">-->
<!-- фальшивий background -->
<div class="falshBackground"></div>
<form style="display: none" data-visible="false" role="auth" id="authForm" action="../controller/controller.php" method="postfor">
    <div>
        <div>
            <a href="../index.php">
                <img src="../img/warhammer-40000-logo.png" alt="">
            </a>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" id="email">Email</label><span id="closeRegAuthForm">&times;</span><br>
        <input data-valid="false" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small ">Мы никогда не передадим вашу электронную почту кому-либо еще.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input data-valid="false" name="pass" type="password" class="form-control" id="pass" placeholder="Password">
        <small class="form-text">Пароль должен содержать прописные,заглавные символы и цифры.</small>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
    </div>
    <button disabled id="btnEnter" class="not-active" name="enter">Вход</button>
    <button id="registration" name="registration">Регистрация</button>
</form>