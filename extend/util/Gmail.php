<?php

namespace util;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Gmail
{

    const EMAIL = "tonshming@gmail.com";

    const PASSWORD = 'kuzbwifpyvzfrxdh';

    /**
     * Gmail发送邮件
     * @param string $email 收件人邮箱
     * @param string $title 邮箱标题
     * @param string $body 邮箱内容<html>
     * @param string $altBody 邮箱内容<非html,客户端不支持html时，发送该内容>
     * @return bool
     */
    public static function send(string $email, string $title, string $body, string $altBody = ''): bool
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //服务器配置
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = self::EMAIL;
            $mail->Password = self::PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;                            // ssl加密的服务器端口 25 或者465 具体要看邮箱服务器支持
//            $mail->SMTPSecure = 'ssl';
//            $mail->Port = 25;                            // ssl加密的服务器端口 25 或者465 具体要看邮箱服务器支持
            $mail->setFrom(self::EMAIL, env("app_name"));  //发件人
            $mail->addAddress($email);  // 收件人
            $mail->addReplyTo(self::EMAIL, 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //Content
            $mail->isHTML(true);                                // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $title;
            $mail->Body = $body;
            $mail->AltBody = $altBody;
//            $mail->proxy = [
//                'proxyHost' => '127.0.0.1',
//                'proxyPort' => '7890'
//            ];
            $mail->send();
            return true;
//            echo '邮件发送成功';
        } catch (Exception $e) {
//            echo '邮件发送失败: ', $mail->ErrorInfo;
            return false;
        }
    }

}

