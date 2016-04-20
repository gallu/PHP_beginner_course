<pre>
<?php

// 一時Cookie(ブラウザを閉じるまで有効、なCookie)
setcookie('temporary_cookie', 'data');

// 一定時間有効なCookie。下記コードは１時間有効
setcookie('constant_time_cookie', 'data', time() + 60*60);

// Cookieを有効にするパス名の指定(指定しない場合)
setcookie('not_specify_path_name_cookie', 'data1', time() + 60*60);
// Cookieを有効にするパス名の指定(指定する場合)
setcookie('specify_path_name_cookie', 'data2', time() + 60*60, '/');

// ドメイン名を指定する
setcookie('specify_domain_name_cookie', 'data', time() + 60*60, '/', 'localhost');

// HTTPSでのみ有効なCookieにする
setcookie('secure_cookie', 'data', time() + 60*60, '/', '', true);

// JavaScriptから閲覧できないように試みる
setcookie('httponly_cookie', 'data', time() + 60*60, '/', '', false, true);

//
echo 'setcookie fin.';
