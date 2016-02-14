<?php
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

// おみくじを引く
$i = mt_rand(0, count($mikuji_array) - 1 );
$mikuji_string = $mikuji_array[$i];

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
