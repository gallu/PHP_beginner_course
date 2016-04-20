<?php
ob_start();
session_start();

// CSRF用のトークンの作成と設定
$csrf_token = '';
try {
    // XXX random_bytesはPHP7以降の関数だが、PHP5.2以降で使えるユーザランド実装( https://github.com/paragonie/random_compat )が存在する
    if(function_exists('random_bytes')) {
        $csrf_token = hash('sha512', random_bytes(128));
    } else if (is_readable('/dev/urandom')) {
        $csrf_token = hash('sha512', file_get_contents('/dev/urandom', false, NULL, 0, 128), false);
    } else if(function_exists('openssl_random_pseudo_bytes')) {
        $csrf_token = hash('sha512', openssl_random_pseudo_bytes(128));
    }
} catch (Exception $e) {
    ; // XXX 後でまとめてエラーチェックするので一端ここでは未処理
}
if ('' === $csrf_token) {
    echo 'CSRFトークンが作成できないので終了します';
    return ;
}

// CSRFトークンは5個まで(で後で追加するので、ここでは4個以下に)
while (5 <= count($_SESSION['csrf_token'])) {
    array_shift($_SESSION['csrf_token']);
}

// セッションに格納
$_SESSION['csrf_token'][$csrf_token] = time();
//var_dump($_SESSION);

//
ob_end_flush();
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>CSRFテスト</title>
</head>
<body>
いらっしゃいませ。<br>
<form name="attackform" method="post" action="http://localhost/30-4-service.php">
題名：<input type="text" name="title"><br>
本文：<input type="text" name="article"><br>
  <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
<br>
<input type="submit" value="送信">
</form>
</body>
</html>
