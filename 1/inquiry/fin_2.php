<?php
// 値を受け取る
$name = (string)@$_POST['name'];
$email = (string)@$_POST['email'];
$inquiry = (string)@$_POST['inquiry'];
var_dump($name);
var_dump($email);
var_dump($inquiry);


?><!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>問い合わせ入力完了</title>
</head>
<body>
お問い合わせいただいてありがとうございます。<br>
折り返し、ｎ日以内にご返信を差し上げますので、しばらくお待ちください。<br>
</body>
</html>
