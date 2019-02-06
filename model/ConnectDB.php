<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14/01/2019
 * Time: 17:03
 */

trait ConnectDB
{
    public $pdo;
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
}