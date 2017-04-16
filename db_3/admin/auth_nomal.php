<?php

// 認証処理のinclude
require_once('./auth.php');

// 権限が1未満ならNG
if (1 > $_SESSION['admin_auth']['role']) {
    // TopPage(認証後トップページ)に遷移させる
    header('Location: ./top.php');
    exit;
}

