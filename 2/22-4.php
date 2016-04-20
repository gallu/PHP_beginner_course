<pre>
<?php

/*
ドットや縦線などを「特殊文字(メタ文字 / メタキャラクタ)」と呼称します。
メタ文字(今回はドット)を「文字として」扱いたい時はバックスラッシュ￥を用います。
*/

//
$string = '0123456789abcdefghijka.c';
$ret = preg_match('/a\.c/', $string, $matches);
var_dump($ret);
var_dump($matches);
