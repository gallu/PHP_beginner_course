<pre>
<?php

/*
文字セットは、例えば [0123456789]と書くと「0から9までの各文字のいずれか一つ」というような意味になります。[abc]なら「aかbかcのいずれか一つ」となります。
次に、文字セットは例えば[0-9]と書く事で範囲を指定できます。アルファベット大文字小文字、なら、[a-zA-Z]という書き方ができます。
*/

//
$string = '0123456789abcdefghijka.c';
$ret = preg_match('/[a-z]/', $string, $matches);
var_dump($ret);
var_dump($matches);
