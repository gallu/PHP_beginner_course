<?php

// 認証処理のinclude
require_once('auth.php');

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座上級</title>
  <style type="text/css">
    .error { color: red; }
  </style>
</head>

<body>
  <h1>ログイン後TopPage</h1>
  <a href="./page_fee.php">有料Page</a><br>
  <a href="./logout.php">ログアウト</a>

</body>
</html>
