<?php
// 値を受け取る
$name = (string)@$_POST['name'];
$email = (string)@$_POST['email'];
$inquiry = (string)@$_POST['inquiry'];
//var_dump($name);
//var_dump($email);
//var_dump($inquiry);

// 必須入力の確認をする
$error_message = '';
if ('' === $email) {
    $error_message = $error_message . '連絡先は必須入力です。<br>';
}
if ('' === $inquiry) {
    $error_message = $error_message . '問い合わせ内容は必須入力です。<br>';
}
// エラーがある場合、メッセージを出力して終了
if ('' !== $error_message) {
    echo $error_message;
    return ;
}


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
