<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-size: 1.2rem;
        }

        p {
            padding: 0.5rem 1rem;
        }
        strong {
            padding: 0.5rem 1rem;
        }

        ul {
            padding-top: 0.5rem;
            padding-left: 3rem;
        }
    </style>
</head>

<body>
<p>Здравствуйте!</p>
<strong>Данные вашего аккаунта:</strong>
<ul>
    <li>Главная страница: <a href="../index.php">CitadelOfWar</a></li>
    <li>Логин (username): <strong><?php echo $login ?></strong></li>
    <li>Пароль (password): <strong><?php echo $password?></strong></li>
</ul>
<p>Для того что бы писать сообщения и загружать фотографии на форуме, необходимо подтвердить регистрацию <a href="http://mymartynenko.mcdir.ru/controller.php?verificationCode=<?php echo $emailHash ?>">http://mymartynenko.mcdir.ru/controller.php?verificationCode=<?php echo $emailHash ?></a></p>
<p>С уважением <a href="../index.php">CitadelOfWar</a>.</p>
</body>

</html>