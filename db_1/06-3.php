<?php

/*
 * データのSELECT
 */

// DBの接続
// XXX 既存で書いたコードを流用する
require_once('05-1.php');

/*
 * SELECT文の作成と発行
 *
 * テーブルは、06.sqlにある「practice_6」を使います
 */
// 前提：SELECTする文字列を変数に入れておく：本来のWebアプリだと、$_POSTなどから取得する事が多い
$num = 10;

// 手順１：準備された文(プリペアドステートメント)を作成する
$sql = 'SELECT * FROM practice_6 WHERE num=:num;';
$pre = $dbh->prepare($sql);

// 手順２：プレースホルダーに値をバインドする
$pre->bindValue(':num', $num, PDO::PARAM_INT); // 数値は、出来るだけ「明示的にPDO::PARAM_INTを指定する」ほうがより好ましいです

// 手順３：SQLを実行する
$r = $pre->execute();
if (false === $r) {
    // エラー処理
    // エラー時の情報は以下に入っている
    // var_dump($pre->errorInfo());
}

// 取得データの表示
// 「ブラウザで動かす」ので、XSS用にエスケープ処理を加えます
require_once('06-h.php'); // エスケープ処理関数が書いてあるファイルを取り込む
//
echo '<br><br>';

// 1行を取り出す(今回は「１行しかない」事がわかっているので)
$row = $pre->fetch(PDO::FETCH_ASSOC);
foreach($row as $key => $val) {
    // 出力用の変数を作成する
    $key_e = h($key);
    $val_e = h($val);
    // 出力
    echo "{$key_e} => {$val_e}<br>\n";
}

