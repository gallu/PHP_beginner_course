<?php

// 認証処理のinclude
require_once('./auth_full_control.php');

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座上級 管理画面</title>
  <style type="text/css">
    .error { color: red; }
  </style>
</head>

<body>
  <h1>ログイン後TopPage：管理者権限のあるPage</h1>
  <a href="./top.php">閲覧のみでもOK Page</a><br>
  <a href="./top_nomal.php">通常ユーザ以上Page</a><br>
  <a href="./top_full_control.php">管理者管理権限のあるPage</a><br>
  <a href="./logout.php">ログアウト</a>

</body>
</html>
