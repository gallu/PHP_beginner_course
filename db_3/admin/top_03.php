<?php

// 認証処理のinclude
require_once('./auth.php');

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座上級 管理画面</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <h1>ログイン後TopPage</h1>
  <a href="./user_list.php">一覧(any)</a><br>
  <a href="./register.php">管理者登録(admin)</a><br>
  <a href="./front_password_change.php">一般ユーザのパスワード上書き(nomal)</a><br>
  <hr>
  <a href="./top.php">閲覧のみでもOK Page(any)</a><br>
  <a href="./top_nomal.php">通常ユーザ以上Page(nomal)</a><br>
  <a href="./top_full_control.php">管理者管理権限のあるPage(admin)</a><br>
  <a href="./logout.php">ログアウト</a>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
