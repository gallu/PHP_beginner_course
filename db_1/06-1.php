<?php

/*
 * データのinsert
 */

// DBの接続
// XXX 既存で書いたコードを流用する
require_once('05-1.php');

/*
 * INSERT文の作成と発行
 *
 * テーブルは、06.sqlにある「practice_6」を使います
 */
// 前提：INSERTする文字列を変数に入れておく：本来のWebアプリだと、$_POSTなどから取得する事が多い
$data = 'hoge';
$data2 = 'hoge222';
$num = 10;

// 手順１：準備された文(プリペアドステートメント)を作成する
$sql = 'INSERT INTO practice_6(data, data2, num) VALUES( :data, :data2, :num );';
$pre = $dbh->prepare($sql);

// 手順２：プレースホルダーに値をバインドする
$pre->bindValue(':data', $data, PDO::PARAM_STR);
$pre->bindValue(':data2', $data2); // PDO::PARAM_STRはデフォルト値なので、省略も可能です
$pre->bindValue(':num', $num, PDO::PARAM_INT); // 数値は、出来るだけ「明示的にPDO::PARAM_INTを指定する」ほうがより好ましいです

// 手順３：SQLを実行する
$r = $pre->execute();
if (false === $r) {
    // エラー処理
    // エラー時の情報は以下に入っている
    // var_dump($pre->errorInfo());
}

// 確認用のSQL
// SELECT * FROM practice_6;

