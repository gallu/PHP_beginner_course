<?php
// sessionを使うので、出力バッファリングをしておく
ob_start();
session_start();

// ログアウト処理
$_SESSION['user_id'] = '';

//
ob_end_flush();
?>
ログアウト処理をしました！
