<?php

/*
 * 14-3-insert.php と 14-3-select.php に共通な関数や処理をまとめたファイル
 */

// 出力時に必須の関数
// (HTML用 エスケープ関数)
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// DBに接続
$user = 'sample';
$pass = 'sample';
$dsn = 'mysql:dbname=sample;host=localhost;charset=utf8';
//
try {
  $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  echo "connect error!! (" , $e->getMessage() , ")";
  return ;
}
// 静的プレースホルダを指定
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

