<?php
// パラメタを受け取る
$id = $_GET['id'];
var_dump($id);

?><!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>問い合わせ詳細</title>
</head>
<body>
<h1>問い合わせ詳細</h1>
お名前：○○○○○○<br>
連絡先：xxxxxxxxxxxxxxxxxxxx<br>
問い合わせ日時：yyyy-mm-dd hh:mm:ss<br>
問い合わせ内容：<br>
<pre>
○○○○○○
○○○○○○
○○○○○○
○○○○○○
○○○○○○
</pre>
<br>
<a href="./index.php">一覧に戻る</a>
</body>
</html>
