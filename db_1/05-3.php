<?php

/*
 * PHPのバージョンが古い(PHP5.3.6未満)、かつ、MySQLのバージョンが古い(MySQL5.5.3未満)の場合
 */

// データの設定
// XXX 実際は、configファイル等で外出しにする事が多い
$user = 'root';
$pass = '';
$dsn = 'mysql:dbname=test;host=localhost';

// 接続オプションの設定
$opt = array (
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // XXX MySQLのバージョンが古いので、文字コードがutf8mb4ではない
    PDO::ATTR_EMULATE_PREPARES => false,
);

// 接続
try {
    $dbh = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    // エラーは、以下に入っている
    echo $e->getMessage();
}

// 接続ハンドルの確認
var_dump($dbh);
