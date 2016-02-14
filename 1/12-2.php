<?php

// セッションの開始
session_start();

//
$session_name = 'php_study_counter';

// カウンタ値の取得
$counter = (false === isset($_SESSION[$session_name])) ? 0 : $_SESSION[$session_name];

// sessionを設定
$_SESSION[$session_name] = $counter + 1;

// 簡単に出力
if (0 == $counter) {
  echo "初めまして！";
} else {
  echo "いままでに" , $counter , "回いらっしゃいましたね!";
}
