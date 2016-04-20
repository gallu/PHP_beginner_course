<?php

// PDOでの接続
$dsn = 'mysql:dbname=test;host=localhost;charset=utf8mb4';
try {
    $dbh = null;
    $dbh = @new PDO($dsn, 'root', '');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // 静的プリペアドステートメントを明示的に指定
} catch (PDOException $e) {
    echo "DB接続エラー\n";
}
//var_dump($dbh);

/*
 SQLは、以下の３手順で発行する
 ・準備された文(プリペアドステートメント)の用意
 ・プレースホルダへの、値の紐づけ(バインド)
 ・SQL文の実行
 */

// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM data WHERE column = :column ;';
$pre = $dbh->prepare($sql);

// プレースホルダへの、値の紐づけ(バインド)
$pre->bindValue(':column', $_GET['search_word']);

// SQL文の実行
// SQL文を発行する
$r = $pre->execute();
if (false === $r) {
    // エラー処理
    return ;
}

// データの取得
while($row = $pre->fetch(PDO::FETCH_ASSOC)) {
    // 一端、ざっくりと表示
    var_dump($row);
}
