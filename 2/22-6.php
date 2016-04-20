<pre>
<?php

/*
次に文字クラスです。或いは「文字クラスの中のメタ文字」というケースもあります。
まず、多くの正規表現で使われるメタ文字で「否定」があります。
[^abc]
とある場合。先頭の^が「否定」を意味するために「abc以外」という意味になります。
*/

//
$string = '0123456789abcdefghijka.c';
$ret = preg_match('/[^1-9]/', $string, $matches);
var_dump($ret);
var_dump($matches);
