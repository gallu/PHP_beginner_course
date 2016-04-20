<pre>
<?php

//
$s = 'All in the golden afternoon Full leisurely we glide;';

// (一見)正しい判定
$r = strpos($s, 'afternoon');
var_dump($r);
if (false == $r) {
    echo "検索文字列は見つかりませんでした orz\n";
} else {
    echo "検索文字列が見つかりました！！\n";
}

// 不適切な判定
$r = strpos($s, 'All');
var_dump($r);
if (false == $r) {
    echo "検索文字列は見つかりませんでした orz\n";
} else {
    echo "検索文字列が見つかりました！！\n";
}

// 適切な判定
$r = strpos($s, 'All');
var_dump($r);
if (false === $r) {
    echo "検索文字列は見つかりませんでした orz\n";
} else {
    echo "検索文字列が見つかりました！！\n";
}
