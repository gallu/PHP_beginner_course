<?php
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
$sql = 'SELECT * FROM inquiry_data;';
$pre = $dbh->prepare($sql);

// 値を紐づける
// XXX 今回はなし

// SQL文を発行する
$r = $pre->execute();
if (false === $r) {
    // エラーが発生したので表示
    var_dump($pre->errorInfo());
    return;
}

// データを取得する
while($row = $pre->fetch(PDO::FETCH_ASSOC)) {
    // 一端、ざっくりと表示
    var_dump($row);
}

