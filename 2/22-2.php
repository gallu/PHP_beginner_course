<pre>
<?php

// ここで「ドット .」は特別な意味を持ち「任意の１文字」

//
$string = '0123456789abcdefghijk';
$ret = preg_match('/a.c./', $string, $matches);
var_dump($ret);
var_dump($matches);

