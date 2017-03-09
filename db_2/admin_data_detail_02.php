<?php

/*
 * (管理画面想定)１件のform情報の詳細
 */

// HTTP responseヘッダを出力する可能性があるので、バッファリングしておく
ob_start();

// 共通関数のinclude
require_once('common_function.php');


// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う

// パラメタを受け取る
$test_form_id = (string)@$_GET['test_form_id'];
// 最低限程度のエラーチェック
if ('' === $test_form_id) {
    header('Location: ./admin_data_list.php');
    exit;
}
// 確認
//var_dump($test_form_id);

// DBハンドルの取得
$dbh = get_dbh();

// SELECT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM test_form WHERE test_form_id = :test_form_id;';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':test_form_id', $test_form_id, PDO::PARAM_INT);

// SQLの実行
$r = $pre->execute();
if (false === $r) {
        // XXX 本当はもう少し丁寧なエラーページを出力する
        echo 'システムでエラーが起きました';
        exit;
}

// データを取得
$data = $pre->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);
// 最低限程度のエラーチェック
if (true === empty($data)) {
    header('Location: ./admin_data_list.php');
    exit;
}
// else
$datum = $data[0]; // 「１件しかでてこない」はずなので、あらかじめ「１件分のデータ」を把握しておく
//var_dump($datum);

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座中級: 管理画面イメージ</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

<div class="container">
  <h1>フォーム内容詳細</h1>
  <table class="table table-hover">
  <tr>
    <td>form ID
    <td><?php echo h($datum['test_form_id']); ?>
  <tr>
    <td>名前
    <td><?php echo h($datum['name']); ?>
  <tr>
    <td>郵便番号
    <td><?php echo h($datum['post']); ?>
  <tr>
    <td>住所
    <td><?php echo h($datum['address']); ?>
  <tr>
    <td>誕生日
    <td><?php echo h($datum['birthday']); ?>
  <tr>
    <td>作成日時
    <td><?php echo h($datum['created']); ?>
  <tr>
    <td>修正日時
    <td><?php echo h($datum['updated']); ?>
  </table>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
