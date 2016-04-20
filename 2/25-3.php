<?php
// Cookieを使うので、出力バッファリングをしておく
ob_start();

// おみくじの群れを用意する
$mikuji_array = array(
  //'<img src="">大大吉',
  '大大吉',
  '大吉',
  '中吉',
  '小吉',
  '吉',
  '末吉',
  '凶',
  '大凶',
);
//var_dump($mikuji_array);
//var_dump($mikuji_array[0]);

// Cookieを使っての判定
$today = date('Ymd');
if (true === isset($_COOKIE[$today])) {
  // すでに「本日」おみくじを引いている場合、その内容を用いる
  $i = $_COOKIE[$today];

  // 外部からの情報なので、入力をvalidate
  // XXX 「$mikuji_arrayの配列個数」内であればいいので、「$mikuji_arrayの個数でmod(モジュラ計算)を取る」ことで問題ない値にする
  $i = $i % count($mikuji_array);
} else {
  // まだ「本日」おみくじを引いていない場合、おみくじを引く
  $i = mt_rand(0, count($mikuji_array) - 1 );

  // Cookieに設定する
  setcookie($today, $i, time() + 86400); // 「最大で１日(86400秒)」データを保持する
}
// 出力用の文字列を把握する
$mikuji_string = $mikuji_array[$i];

// 出力バッファリングを終了する
ob_end_flush();
?>
<html>

<head>
  <title>おみくじ</title>
</head>

<body>
今日のあなたの運勢は
【<?php echo $mikuji_string; ?>】です！
</body>

</html>
