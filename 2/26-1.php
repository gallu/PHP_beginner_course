<pre>
<?php

// 一番古典的なベンダー固有モジュール(現在非推奨、PHP7.0.0で削除)
$dbh = @mysql_connect('localhost', 'root', '');
var_dump($dbh);
if (false === $dbh) {
    echo "DB接続エラー\n";
} else {
    mysql_select_db('test', $dbh);
    mysql_query('SET NAMES utf8mb4', $dbh);
}

// 推奨されているベンダー固有モジュール
$dbh = @mysqli_connect('localhost', 'root', '', 'test');
var_dump($dbh);
if (false === $dbh) {
    echo "DB接続エラー\n";
} else {
    mysqli_set_charset($dbh, 'utf8mb4');
}

// オブジェクト指向的な記述も可能
$dbh = @new mysqli('localhost', 'root', '', 'test');
@var_dump($dbh);
if (NULL != $dbh->connect_error) {
    echo "DB接続エラー\n";
} else {
    $dbh->set_charset('utf8mb4');
}

// PEARにあるMDB2での接続
require_once('MDB2.php');
$dns = 'mysql://root:@localhost/test?charset=utf8mb4';
$dbh = MDB2::connect($dns);
if (PEAR::isError($dbh)) {
    echo "DB接続エラー\n";
}
var_dump($dbh);

// PDOでの接続
$dsn = 'mysql:dbname=test;host=localhost;charset=utf8mb4';
try {
    $dbh = null;
    $dbh = @new PDO($dsn, 'root', '');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // 静的プリペアドステートメントを明示的に指定
} catch (PDOException $e) {
    echo "DB接続エラー\n";
}
var_dump($dbh);

