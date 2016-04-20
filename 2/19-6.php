<pre>
<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

// global変数
$a = 10;

function hoge() {
    // globalの参照の仕方その１
    var_dump($GLOBALS['a']);

    // globalの参照の仕方その２
    global $a;
    var_dump($a);
}

//
hoge();
