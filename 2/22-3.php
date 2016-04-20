<pre>
<?php

/*
「縦線 |」は所謂 or で、「いずれか」という意味になります。
括弧をつかって一括りにすると良いですが、無くても動きます。
*/

//
$string = '0123456789abcdefghijk';
$ret = preg_match('/(abc)|(456)|(ABC)/', $string, $matches);
var_dump($ret);
var_dump($matches);
