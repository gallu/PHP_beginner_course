<?php
// セッションの開始
session_start();
// sessionの値を消す
$_SESSION['counter'] = 0;

// 表示
echo "sessionの値を消しました！";

