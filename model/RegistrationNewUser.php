<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 05/01/2019
 * Time: 13:41
 */

require_once 'Data.php';
require_once 'config.php';

class RegistrationNewUser implements Data
{
    private $email;
    private $nick;
    private $passwordFirst;
    private $passwordSecond;
    private $sex;
    private $birth_date;
    private $registration_time;
    private $captcha_value;
    private $pdo;
    private $status_message_input;
    private $logOutTime;
    private $hashPassword;
    private $hashVerification;

    function __construct($regJSON)
    {
        $JSON_object = json_decode($regJSON,true);
        $this->email = htmlspecialchars($JSON_object['email']);
        $this->nick = htmlspecialchars($JSON_object['nick']);
        $this->passwordFirst = $JSON_object['passwordFirst'];
        $this->passwordSecond = $JSON_object['passwordSecond'];
        $this->sex = $JSON_object['sex'];
        $this->birth_date = self::dateConstructCreate($JSON_object['birth_date']);
        $this->registration_time = time();
        $this->captcha_value = $JSON_object['captcha'];
        $this->hashPassword = crypt($this->hashPassword,SALT);
        $this->hashVerification = self::createHashVerificationStr();
    }
    private function dateConstructCreate($birth_date){
        $str_to_date_format = strtotime($birth_date[0].'-'.$birth_date[1].'-'.$birth_date[2]);
        return $str_to_date_format;
    }
    function connectDB()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME , DB_LOGIN, DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // формат запроса по умолчанию
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]);
        }catch (PDOException $e){
            self::setStatusMessage('Ошибка подключения => '.__CLASS__.'::'.__METHOD__.'::'.$e->getMessage());
        }
    }
    function insertData()
    {
        try {

            return $this->pdo->exec("INSERT INTO ".DB_NAME.".users (id,nick,timeReg,email,sex,birthDate,password,verified) 
                                    VALUES (
                                    null ,
                                    '{$this->nick}',
                                    '{$this->registration_time}',
                                    '{$this->email}',
                                    '{$this->sex}',
                                    '{$this->birth_date}',
                                    '{$this->hashPassword}',
                                    '{$this->hashVerification}'
                                    )");


        } catch (PDOException $e){
            self::setStatusMessage($e->getMessage());
        }
    }

    private function setStatusMessage($str){ //?
        $this->status_message_input = $str;
    }
    function getStatusMessage(){
        return $this->status_message_input;
    }

    function emailValidate(){
        return filter_var($this->email,FILTER_VALIDATE_EMAIL);
    }
    function passwordValidate(){
        return preg_match('/([a-zA-Z0-9]){8,}/',$this->passwordFirst);
    }
    function passwordSecondValidate(){
        return preg_match('/([a-zA-Z0-9]){8,}/',$this->passwordSecond);
    }
    function getNick(){
        return $this->nick;
    }
    function getPasswords(){
        return [$this->passwordFirst,$this->passwordSecond];
    }
    function getCaptcha(){
        return $this->captcha_value;
    }
    function registrationFinish(){
        require_once '../view/regMessageStatus.php';
    }
    function registrationFinishError($message){
        $systemErrMsgText = $message;
        require_once '../view/systemErrMsg.php';
    }
    //хэш из почты который будет в ссылке на подтверждение регистрации и будет заменен на true
    private function createHashVerificationStr(){
        return $this->hashVerification = md5($this->email);
    }
    function getHashVerification(){
        return $this->hashVerification;
    }
}