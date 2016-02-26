<?php
// Cookieの値を消す
setcookie('counter', '', time() - 86400);

// 表示
echo "Cookieの値を消しました！";
