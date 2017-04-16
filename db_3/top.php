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
  <a href="./logout.php">ログアウト</a>

</body>
</html>
