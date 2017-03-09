<?php

/*
 * (管理画面想定)１件のform情報の削除
 */

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');

// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う

// パラメタを受け取る
// XXX エラーチェックは get_test_form() 関数側でやっているのでここではオミット
$test_form_id = (string)@$_POST['test_form_id'];
// 確認
//var_dump($test_form_id);

// CSRFチェック
if (false === is_csrf_token_admin()) {
    // 「CSRFトークンエラー」であることをセッションに格納しておく
    $_SESSION['output_buffer']["error_csrf"]  = true;

    // 編集ページに遷移する
    header('Location: ./admin_data_list.php');
    exit;
}

// DBハンドルの取得
$dbh = get_dbh();

// INSERT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'DELETE FROM test_form WHERE test_form_id = :test_form_id;';
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

// 正常に終了したので、セッション内の「出力用情報」を削除する
unset($_SESSION['output_buffer']);

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座中級</title>
  <style type="text/css">
    .error { color: red; }
  </style>
</head>

<body>
  削除しました。<br>
  <br>
  <a href="./admin_data_list.php">一覧に戻る</a>
</body>
</html>

