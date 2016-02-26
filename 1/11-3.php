<?php
// 値を受け取る
$hoge = $_POST['hoge'];

if ('' == $hoge) {
    // 未入力なら警告を出力
    echo "値が未入力です。";
} else {
    // 値を表示する
    echo htmlspecialchars($hoge, ENT_QUOTES, 'UTF-8');
}


