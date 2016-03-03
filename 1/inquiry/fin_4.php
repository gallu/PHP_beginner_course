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

/*
 * DBにデータを書き込む
 */
// DBに接続
$user = 'root';
$pass = '';
$dsn = 'mysql:dbname=test;host=localhost;charset=utf8mb4';
//
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "connect error!! (" , $e->getMessage() , ")";
    return ;
}
// 静的プレースホルダを指定
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//
//var_dump($dbh);

// タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// 「準備されたSQL文」を用意
$sql = 'INSERT INTO inquiry_data(name, email, inquiry, insert_date) VALUES(:name , :email, :inquiry, :insert_date );';
$pre = $dbh->prepare($sql);

// 値を紐づける
$pre->bindValue(':name', $name);
$pre->bindValue(':email', $email);
$pre->bindValue(':inquiry', $inquiry);
$pre->bindValue(':insert_date', date('Y-m-d H:i:s'));

// SQL文を発行する
$r = $pre->execute();
if (false === $r) {
    // エラーが発生したのでエラー表示
    echo '申し訳ありませんがエラーが発生しました。再度、入力をお願いいたします。<br>';
    echo 'この画面が続く場合、お手数ですが、 hoge@example.net までメールをいただけると幸いです。<br>';
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
