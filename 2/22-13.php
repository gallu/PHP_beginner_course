<pre>
<?php

/*
適切な「行頭」「行末」とは
  \A      文字列先頭
  \z      文字列末尾
となります。
*/

//
$string = "javascript code\nhttp://example.com";
$ret = preg_match('/\Ahttp:/m', $string, $matches);
var_dump($ret);
var_dump($matches);

//
$string = "0123\n";
$ret = preg_match('/[0-9]\z/', $string, $matches);
var_dump($ret);
var_dump($matches);
