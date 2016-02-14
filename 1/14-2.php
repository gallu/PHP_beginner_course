<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php

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


// DBから情報を一式読み出す
// ------------------------------

// 「準備された文(prepared statement)」を用意する
$sql = 'SELECT * FROM test_users;';
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

