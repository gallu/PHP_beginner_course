<pre>
<?php

// 単純なパターン表記は、例えば abc と渡せば「abcという連続した３文字、にマッチするもの」

// マッチする場合
$string = '0123456789abcdefghijk';
$ret = preg_match('/abc/', $string, $matches);
var_dump($ret);
var_dump($matches);

// マッチしない場合
$string = '0123456789ABCDEFGHIJK';
$ret = preg_match('/abc/', $string, $matches);
var_dump($ret);
var_dump($matches);

