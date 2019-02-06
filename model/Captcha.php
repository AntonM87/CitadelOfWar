<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 27/12/2018
 * Time: 22:16
 */

 class Captcha
 {
     const WIDTH = 180;
     const HEIGHT = 60;
     const FONT = '../fonts/font.ttf';
     const FONT_SIZE = 14;
     private $chars;
     private $backgroundColors = [];
     private $captchaStr = '';
     private $captchaLength = 0;
     private $textColor = [];
     private $backgroundTextColors = [];

     public function __construct()
     {
         //генерация массива строк цифр(строки)
         self::createCharsArr();
         //генерация каптчи
         self::createCaptchaStr();
         //сохраняем каптуч в сессии
         self::saveCaptcha();
         //создание изображения и его размеров
         $img = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
         //создание заднего фона
         self::createBackgroundFillColors();
         $background = imagecolorallocate($img,$this->backgroundColors[0],
                                             $this->backgroundColors[1],
                                             $this->backgroundColors[2]);
         //заливка заднего фона
         imagefill($img,0,0,$background);
         //создание ложных цифр и букв
         for ($i = 0;$i < 30;$i++){
             self::createBackgroundTextColors();
             $fontSize = self::dynamicFontSize();
             $letter = self::getRandomBackgroundChr();
             $secondTextColor = imagecolorallocatealpha($img,
                 $this->backgroundTextColors[0],
                 $this->backgroundTextColors[1],
                 $this->backgroundTextColors[2],
                 $this->backgroundTextColors[3]);
             imagettftext($img,$fontSize,rand(-35,35),rand(self::WIDTH * 0.3,self::WIDTH * 0.7),
                 rand(self::HEIGHT * 0.3,self::HEIGHT * 0.7),$secondTextColor,self::FONT,
                $letter);
         }
//         создание проверочного текста
         self::createTextColor();
         //смещение для текста = высота текста
         $bais = self::FONT_SIZE + mt_rand(10,15);
         $x = 0;
         for ($i = 0;$i < strlen($this->captchaStr);$i++){
             $fontSize = self::dynamicFontSize();
             $this->createTextColor();
             $x += $bais;
             $y = self::HEIGHT * 1  / 2 + mt_rand(1,5);
             $textColor = imagecolorallocate($img,
                 $this->textColor[0],
                 $this->textColor[1],
                 $this->textColor[2]);
             imagettftext($img,$fontSize + 5,rand(-25,25),$x,$y,$textColor,self::FONT,$this->captchaStr[$i]);
         }

         header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
         header('Cache-Control: no-store, no-cache, must-revalidate');
         header('Cache-Control: post-check=0, pre-check=0', FALSE);
         header('Pragma: no-cache');

         imagepng($img);
         imagedestroy($img);
     }

     private function createBackgroundTextColors(){
         for ($i = 0; $i < 3; $i++) {
             $this->backgroundTextColors[] = mt_rand(60, 100);
         }
         // рандомное значение прозрачности
         $this->backgroundTextColors[] = mt_rand(70,110);
     }
     private function createBackgroundFillColors()
     {
         for ($i = 0; $i < 3; $i++) {
             $this->backgroundColors[] = mt_rand(180, 240);
         }
     }
     private function createCaptchaStr()
     {
         $this->captchaLength = rand(4, 6);

         $charsArrLength = strlen($this->chars);

         for ($i = 0; $i < $this->captchaLength; $i++) {
             $this->captchaStr .= $this->chars[rand(0, $charsArrLength)];
         }
     }
     private function createCharsArr(){
         //массив символов
         for ($i = 65; $i <= 90; $i++) {
             $this->chars .= chr($i);
         }
         for ($i = 97; $i <= 122; $i++) {
             $this->chars .= chr($i);
         }
         $this->chars .= '0123456789';
     }
     private function dynamicFontSize(){
         return mt_rand(self::FONT_SIZE-2,self::FONT_SIZE+2);
     }
     private function getRandomBackgroundChr(){
         $length = strlen($this->chars) - 1;
         $index = mt_rand(0,$length);
         return $this->chars[$index];
     }
     private function createTextColor(){
         for ($i = 0;$i < 3;$i++){
             $this->textColor[] = mt_rand(10,80);
         }
     }
     private function saveCaptcha(){
         if (!isset($_SESSION['id'])){
             session_start();
             $_SESSION['captcha'] = self::getCaptchaStr();
         }
         $_SESSION['captcha'] = self::getCaptchaStr();
     }
     private function getCaptchaStr(){
         return $this->captchaStr;
     }
 }