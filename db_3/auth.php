<?php

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');

// セッションに入っている情報を確認する
//var_dump($_SESSION);

// セッションに「認証情報」がない場合、「非ログインTopPage(index.php)」に遷移させる( ＝ このPageは表示しない)
if (false === isset($_SESSION['auth'])) {
    //
    header('Location: ./index.php');
    exit;
}
