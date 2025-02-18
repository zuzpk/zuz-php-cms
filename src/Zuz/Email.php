<?php 

namespace Zuz;

use \Zuz\Config;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email{

    public static function Build($subject, $message){
        $_mail = '<div style="padding: 50px;"><div style="background: #ffffff;margin:0 auto;width:520px;font-family:segoe ui regular, sans-serif, arial, tahoma;font-size:16px;position:relative;">
            <div style="color:#333;">
                <a href="' . Config::BASEURL . '?f=mail" style="text-decoration:none;display:block;margin-bottom:50px;"><img src="' . Config::BASEURL . 'ui/images/logo-mail.png" style="display:block;height:100px;outline:none;"></a>
                ' . $message . '							
            </div>
            <div style="padding: 50px 0px;position:relative;color:#999;font-size:12px;width:100%;box-sizing:border-box;text-align: center;">
                &copy;' . date ("Y") . ' ' . Config::APP_NAME . ' &mdash; All Rights Reserved.
            </div>				
        </div></div>';
        return $_mail;
    }

    public static function Template($subject, $message){
        header("Content-Type: text/html");
        echo self::Build($subject, $message);
    }

    public static function Send($to, $subject, $message, $from = "app", $fromSender = null, $debug = false, $return = false){		

        if ($from == "app"){
            $from = array('user' => Config::MAIL_USER, 'pass' => Config::MAIL_PASS, 'name' => Config::APP_NAME);
        }

        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // enable SMTP
        if($debug == true){ $mail->SMTPDebug = 1; } // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_SMTPS; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = Config::MAIL_HOST;
        $mail->Port = Config::MAIL_PORT; // or 587
        $mail->IsHTML(true);
        $mail->Username = $from['user'];
        $mail->Password = $from['pass'];
        if(is_array($fromSender)){
            $mail->addReplyTo($fromSender['mail'], $fromSender['name']);
        }
        $mail->SetFrom($from['user'], $from['name']);
        $mail->Subject = $subject;
        $mail->Body = self::Build($subject, $message);
        $mail->AddAddress($to['mail'], $to['name']);
        try{
            $rest = $mail->Send();
            if($return === true){ return $rest; }	
        }
        catch(Exception $e){
            
        }
    }

}
?>