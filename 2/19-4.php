<pre>
<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

// これは正しい
function hoge($a, $b = 10) {
}

// これも正しい
function foo($a = NULL, $b = 'ok') {
}

// これは間違い
function bar($a = false, $b) {
    echo "call bar()\n";
    var_dump($a);
    var_dump($b);
    echo "\n";
}

// これも間違い
function hogefoo($a = false, $b, $c = 10) {
    echo "call hogefoo()\n";
    var_dump($a);
    var_dump($b);
    var_dump($c);
    echo "\n";
}

// これは正しい
function hogebar($a = false, $b = 'ok', $c = 10) {
}

//
hoge(10);
hoge(10, 20);

//
bar(10);
bar(10, 20);
//
hogefoo(10);
hogefoo(10, 20, 30);

