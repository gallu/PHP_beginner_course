<?php

/*
 * (管理画面想定)情報の一覧
 */

// 共通関数のinclude
require_once('common_function.php');


// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う


// DBハンドルの取得
$dbh = get_dbh();

// SELECT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM test_form;';
$pre = $dbh->prepare($sql);

// 値のバインド
// XXX 今回はプレースホルダがないので、バインドはなし

// SQLの実行
$r = $pre->execute();
if (false === $r) {
        // XXX 本当はもう少し丁寧なエラーページを出力する
        echo 'システムでエラーが起きました';
        exit;
}

// データをまとめて取得
$data = $pre->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座中級: 管理画面イメージ</title>
</head>

<body>
<h1>フォーム内容一覧</h1>
<table>
<?php foreach($data as $datum): ?>
<tr>
  <td><?php echo h($datum['test_form_id']); ?>
  <td><?php echo h($datum['name']); ?>
  <td><?php echo h($datum['created']); ?>
  <td><?php echo h($datum['updated']); ?>
<?php endforeach; ?>

</table>


</body>
</html>
