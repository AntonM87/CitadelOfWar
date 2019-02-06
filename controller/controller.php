<?php
session_start();

require_once '../model/ConnectDB.php';
require_once '../model/RegistrationNewUser.php';
require_once '../model/Verification.php';

//подключение формы регистрации
if (isset($_GET['registrationForm'])) {
    include_once '../view/formRegistration.php';
}
//регистрация
if (isset($_POST['regJSON'])){

    $regUserData = new RegistrationNewUser($_POST['regJSON']);

    //валидация полей формы регистрации
    if ($regUserData->emailValidate()){
        if (preg_match('/([a-zA-Zа-яА-Я\-\_]+){3,}/',$regUserData->getNick())){
            if ($regUserData->getPasswords()[0] == $regUserData->getPasswords()[1]){
                if (preg_match('/([a-zA-Z0-9]){8,}/',$regUserData->getPasswords()[0])){
                    if ($_SESSION['captcha'] == $regUserData->getCaptcha()){

                        $regUserData->connectDB();
                        $systemErrMsgText = $regUserData->getStatusMessage();
                        // ориентир на кол-во затронутных строк в бд, если не ноль значит регистрация успешна
                        // иначе сообщение об ошибке
                        $result = $regUserData->insertData();

//                        echo "<h1 style='color: red'>$result</h1>";
                        if ($result) {
                            $regUserData->registrationFinish();

                            //отправка сообщения пользователю для подтверждения регистрации
//                            $verification = new Verification(
//                                $regUserData->getNick(),
//                                $regUserData->getPasswords()[0],
//                                $regUserData->getHashVerification()
//                            );
//                            $verification->sendMail();


                        } else {
                            $regUserData->registrationFinishError('Такой пользователь уже есть');
                        }
                    } else {
                        $regUserData->registrationFinishError('Каптча не совпадает');
                    }
                } else {
                    $regUserData->registrationFinishError('Пароль не верного формата');
                }
            } else {
                $regUserData->registrationFinishError('Пароли не совпадают');
            }
        } else {
            $regUserData->registrationFinishError('Данные введены не верно(Ник)');
        }
    } else {
        $regUserData->registrationFinishError('Данные введены не верно(Почта)');
    }
}
//рестарт каптчи
if (isset($_GET['captchaRestart'])) {
    echo '<img src = "../model/captcha_img.php">';
}
//поиск свободного email по базе
if (isset($_GET['emailEmptyPlace'])){
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME , DB_LOGIN, DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // формат запроса по умолчанию
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
    }catch (PDOException $e){
        self::setStatusMessage('Ошибка подключения => '.$e->getMessage());
    }
    $query = 'SELECT `email` FROM `'.DB_NAME.'`.'.'`users` WHERE `email` = ?';
    $query = $pdo->prepare($query);
    $query->execute([$_GET['emailEmptyPlace']]);
    $result = $query->fetch();
    echo $result['email'];
}
//поиск свободного nick по базе
if (isset($_GET['nickEmptyPlace'])){
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME , DB_LOGIN, DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // формат запроса по умолчанию
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
    }catch (PDOException $e){
        self::setStatusMessage('Ошибка подключения => '.$e->getMessage());
    }
    $query = 'SELECT `nick` FROM `'.DB_NAME.'`.'.'`users` WHERE `nick` = ?';
    $query = $pdo->prepare($query);
    $query->execute([$_GET['nickEmptyPlace']]);
    $result = $query->fetch();
    echo $result['nick'];
}