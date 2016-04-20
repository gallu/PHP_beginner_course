<pre>
<?php

/*
一般的に「行頭は＾、行末は＄で表す」という記述が多いのですが、実際には改行コードとの組み合わせで、必ずしも意図しない文字列がマッチする可能性があります。
些か「クラックっぽい」文字列で確認をしてみます。
*/

//
$string = "javascript code\nhttp://example.com";
$ret = preg_match('/^http:/m', $string, $matches);
var_dump($ret);
var_dump($matches);

//
$string = "0123\n";
$ret = preg_match('/[0-9]$/', $string, $matches);
var_dump($ret);
var_dump($matches);
