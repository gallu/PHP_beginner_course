<pre>
<?php

/*
数量詞を指定した場合、原則として「一番初めに出てきた、一番長いもの」を選び出します。
これを「最長一致」と言います。
しかし時として「マッチする一番短いのが欲しい」ケースもあります。それを最短一致と言います。
数量詞に出てきた？とは意味が異なるので注意しましょう。
*/

//
$string = '0a01ab0123abc01234abcde012345abcdef';

// アスタリスク
$ret = preg_match('/\w*/', $string, $matches);
var_dump($ret);
var_dump($matches);
// 最短一致
$ret = preg_match('/\w*?/', $string, $matches);
var_dump($ret);
var_dump($matches);

// プラス
$ret = preg_match('/\w+/', $string, $matches);
var_dump($ret);
var_dump($matches);
// 最短一致
$ret = preg_match('/\w+?/', $string, $matches);
var_dump($ret);
var_dump($matches);

// {}
$ret = preg_match('/\w{5,8}/', $string, $matches);
var_dump($ret);
var_dump($matches);
// 最短一致
$ret = preg_match('/\w{5,8}?/', $string, $matches);
var_dump($ret);
var_dump($matches);
