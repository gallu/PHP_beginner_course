<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<h1>PHP初級学習用テキスト</h1>
<h2>XSS脆弱性を対策したform</h2>
<?php
if (true === isset($_POST['name'])) {
  echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') , 'さん、ようこそ！';
}
?>
<br>
<form action="./23-1.php" method="post">
名前：<input type="text" name="name"><br>
<br>
<input type="submit" value="確認する">
</form>
</body>
</html>
