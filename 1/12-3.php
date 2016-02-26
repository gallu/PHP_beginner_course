<?php
// セッションの開始
session_start();

// カウンタ値の取得
if (false === isset($_SESSION['counter'])) {
    $counter = 0;
    $_SESSION['counter'] = 0;
} else {
    $counter = $_SESSION['counter'];
}

// sessionに新しい値を設定
$_SESSION['counter'] += 1;

// 出力
if (0 == $counter) {
    echo "初めまして！";
} else {
    echo "いままでに";
    echo htmlspecialchars($counter, ENT_QUOTES, 'UTF-8');
    echo "回いらっしゃいましたね!";
}
