<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14/01/2019
 * Time: 16:57
 */

class Verification
{
    private $nick;
    private $pass;
    private $emailHash;
    private $emailBody;

    function __construct($nick,$pass,$emailHash)
    {
        $this->nick = $nick;
        $this->pass = $pass;
        $this->emailHash = $emailHash;
        $this->emailBody = require_once 'view/post_verification_templ.php';
    }
    function sendMail(){
        mail('anton.m.87@mail.ru','CitadelOfWar registration',
            "<iframe>$this->emailBody</iframe>",
            'Content-type: text/html');
    }
}