<?php

// セッションの開始
ob_start();
session_start();

// セッションの認証情報を削除
unset($_SESSION['admin_auth']);

// 非ログインTopPageに遷移
header('Location: ./index.php');
