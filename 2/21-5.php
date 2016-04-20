<?php

/*
 * XMAPPは、そのままだとmailは送信できません。別途XAMPPの設定が必要になるのでご注意ください
 */


$to = 'furu@example.com';
$subject = 'test subject';
$body = "test mail\n this is test.";

//$r = mail($to, $subject, $body);
//var_dump($r);

//
$headers = 'From: info@example.com' . "\r\n";
//$r = mail($to, $subject, $body, $headers);
//var_dump($r);

//
$subject = '日本語タイトル';
$body = '日本語のメール本文だよ';
//$r = mail($to, $subject, $body, $headers);
//var_dump($r);

// XXX 文字コードはUTF-8で送信される
mb_language("Japanese");
mb_internal_encoding("UTF-8");
//$r = mb_send_mail($to, $subject, $body, $headers);
//var_dump($r);

// 「どうしてもjis(iso-2022-jp)で送信したい場合の方法１案
$subject = '=?ISO-2022-JP?B?' . base64_encode(mb_convert_encoding($subject, 'jis', 'UTF-8')) . '?=';
$body = mb_convert_encoding($body, 'jis', 'UTF-8');
//$r = mail($to, $subject, $body, $headers);
//var_dump($r);
