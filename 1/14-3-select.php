<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php

// 共通処理部分を読み込み
require_once('14-3-common.php');

// DBから情報を一式読み出す
// ------------------------------

// 「準備された文(prepared statement)」を用意する
$sql = 'SELECT * FROM test_users ORDER BY user_id DESC;';
$pre = $dbh->prepare($sql);

// プレースホルダーに値をバインドする
// XXX このプログラムでは特にバインドする値はないので省略

// SQLを実行する
$res = $pre->execute();

// 情報を取得し、テーブルとして出力する
echo "<table border='1'>\n";
//
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
  //
  echo "  <tr>\n";
  foreach($row as $key => $val) {
    echo "    <td>", h($val), "</td>\n";
  }
  echo "  </tr>\n\n";
}
echo "</table>\n";

