<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<h1>PHP初級学習用テキスト</h1>
<h2>XSS脆弱性のあるform</h2>
<?php
if (true === isset($_POST['name'])) {
  // echo $_POST['name'] , 'さん、ようこそ！'; // 実験するときはここのコメントアウトを外す
}
?>
<br>
<form action="./23-4.php" method="post">
名前：<input type="text" name="name"><br>
<br>
<input type="submit" value="確認する">
</form>
</body>
</html>
