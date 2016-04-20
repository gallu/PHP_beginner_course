<pre>
<?php

function hoge($option) {
    $s = '123１２３abcａｂｃぜんかくゼンカクﾀﾞｸｵﾝ';
    $s2 = mb_convert_kana($s, $option, 'UTF-8');
    echo "{$option} => {$s2}\n";
}

//
hoge('r');
hoge('R');
hoge('n');
hoge('N');
hoge('a');
hoge('A');
hoge('k');
hoge('K');
hoge('KV');
hoge('c');
hoge('C');
hoge('h');
hoge('H');
hoge('HV');

