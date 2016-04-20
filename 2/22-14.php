<pre>
<?php
//
mb_regex_encoding('UTF-8');
//
$string = "あいうえお";

//
$ret = mb_ereg('...', $string, $matches);
var_dump($ret);
var_dump($matches);

// 参考
// XXX UTF-8のひらがななので、「３バイトでひらがな１文字」になる
$ret = preg_match('/.../', $string, $matches);
var_dump($ret);
var_dump($matches);
