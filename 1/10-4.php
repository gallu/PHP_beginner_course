<?php
// 関数の定義
function fourth_func($i) {
    $ret = $i * 2; // 引数の値を二倍にする
    return $ret;
}

// 関数の呼び出し
$i = fourth_func(100);
echo $i;
