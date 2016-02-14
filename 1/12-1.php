<?php

// 出力時に必須の関数
// (HTML用 エスケープ関数)
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

//
$cookie_name = 'php_study_counter';

// カウンタ値の取得
$counter = (false === isset($_COOKIE[$cookie_name])) ? 0 : $_COOKIE[$cookie_name];

// cookieを設定
//setcookie($cookie_name, $counter + 1); // 一時Cookie
setcookie($cookie_name, $counter + 1, time() + 60*60*24 * 30); // Cookieの有効期
限を30日に設定

// 簡単に出力
if (0 == $counter) {
  echo "初めまして！";
} else {
  echo "いままでに" , h($counter) , "回いらっしゃいましたね!";
}
