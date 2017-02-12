<?php

/*
 * データのSELECT：where指定なし全件
 */

// DBの接続
// XXX 既存で書いたコードを流用する
require_once('05-1.php');

/*
 * SELECT文の作成と発行
 *
 * テーブルは、06.sqlにある「practice_6」を使います
 */
// 手順１：準備された文(プリペアドステートメント)を作成する
$sql = 'SELECT * FROM practice_6;';
$pre = $dbh->prepare($sql);

// 手順２：プレースホルダーに値をバインドする
// XXX 今回はプレースホルダー(:xx)がないので無し。「無い事」をコメントに書いておくと丁寧

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

// 全行を取り出す：fetch()を使う場合
while($row = $pre->fetch(PDO::FETCH_ASSOC)) {
    foreach($row as $key => $val) {
        // 出力用の変数を作成する
        $key_e = h($key);
        $val_e = h($val);
        // 出力
        echo "{$key_e} => {$val_e}<br>\n";
    }
    echo "<br>\n"; // レコード区切り用の改行
}

/*
// 全行を取り出す：fetchAll()を使う場合
$rows = $pre->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row) {
    foreach($row as $key => $val) {
        // 出力用の変数を作成する
        $key_e = h($key);
        $val_e = h($val);
        // 出力
        echo "{$key_e} => {$val_e}<br>\n";
    }
    echo "<br>\n"; // レコード区切り用の改行
}
*/
