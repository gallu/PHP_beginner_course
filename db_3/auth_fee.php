<?php

// 認証処理のinclude
require_once('auth.php');

// 権限の確認
// XXX 一端「有料または無料」なので、単純な比較処理
if (1 != $_SESSION['auth']['role']) {
    //
    header('Location: ./top.php');
    exit;
}



