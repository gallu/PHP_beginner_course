<?php
// sessionを使うので、出力バッファリングをしておく
ob_start();
session_start();

// ログインの判定処理
if ( (false === isset($_SESSION['user_id']))or('' === $_SESSION['user_id']) ) {
  echo '非ログイン状態です。';
} else {
  echo 'ログインしている状態です。';
}

//
ob_end_flush();
