<?php
ob_start();
session_start();

// CSRFチェック
$post_csrf_token = (string)@$_POST['csrf_token'];
if (false === isset($_SESSION['csrf_token'][$post_csrf_token])) {
    echo 'CSRF トークン NG'; // 実際には出力しない。サンプルコードなので確認用に
    return ;
}
// 寿命を把握して
$ttl = $_SESSION['csrf_token'][$post_csrf_token];
// 先にトークンは削除(使い捨てなので)
unset($_SESSION['csrf_token'][$post_csrf_token]);

// 寿命チェック(1分以内)
if (time() >=  $ttl + 60) {
    echo 'CSRF トークン NG(寿命)'; // 実際には出力しない。サンプルコードなので確認用に
    return ;
}

// else
var_dump($_POST);
echo "正しいルートからの入力！！！！";

