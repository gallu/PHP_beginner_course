<?php
// パラメタを受け取る
$id = $_GET['id'];
//var_dump($id);

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
$sql = 'SELECT * FROM inquiry_data WHERE inquiry_id = :inquiry_id;';
$pre = $dbh->prepare($sql);

// 値を紐づける
$pre->bindValue(':inquiry_id', $id);

// SQL文を発行する
$r = $pre->execute();

// データを取得する
$row = $pre->fetch(PDO::FETCH_ASSOC);
var_dump($row);

?><!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>問い合わせ詳細</title>
</head>
<body>
<h1>問い合わせ詳細</h1>
お名前：○○○○○○<br>
連絡先：xxxxxxxxxxxxxxxxxxxx<br>
問い合わせ日時：yyyy-mm-dd hh:mm:ss<br>
問い合わせ内容：<br>
<pre>
○○○○○○
○○○○○○
○○○○○○
○○○○○○
○○○○○○
</pre>
<br>
<a href="./index.php">一覧に戻る</a>
</body>
</html>
