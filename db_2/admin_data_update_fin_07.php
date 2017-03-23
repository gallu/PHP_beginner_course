<?php

/*
 * (管理画面想定)１件のform情報の編集完了処理
 */

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('test_form_data.php');

// 日付関数(date)を使うのでタイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// ユーザ入力情報を保持する配列を準備する
$user_edit_data = array();

// 「パラメタの一覧」を把握
$params = array('name', 'post', 'address', 'birthday');
// データを取得する
foreach($params as $p) {
    $user_edit_data[$p] = (string)@$_POST[$p];
}
// 確認
//var_dump($user_edit_data);

// test_form_idは別途取得しておく
$test_form_id = (int)@$_POST['test_form_id'];

// ユーザ入力のvalidate
// --------------------------------------
// 基本のエラーチェック
$error_detail = validate_test_form($user_edit_data);

// 編集用、追加のエラーチェック
// 必須チェックを実装
// 空文字(未入力)なら
if ('' === $user_edit_data['birthday']) {
    // 「必須情報の未入力エラー」であることを配列に格納しておく
    $error_detail["error_must_birthday"] = true;
}

// 誕生日
// 一端フォーマットを整える
// XXX strtotime() 関数はある程度「如何様にも」解釈をしてくれる関数だが、管理画面なので一端「ざっくりと」確認、程度にしておく
$t = strtotime($user_edit_data['birthday']);
if (false === $t) {
    // 「誕生日のフォーマットエラー」であることを配列に格納しておく
    $error_detail["error_format_birthday"] = true;
} else {
    // 文字列に置きなおして
    $s = date('Y-m-d', $t);
    // 年、月、日に分解
    list($yy, $mm, $dd) = explode('-', $s);

    // PHPの標準関数を使って日付の妥当性をチェックする
    if (false === checkdate($mm, $dd, $yy)) {
        // 「誕生日のフォーマットエラー」であることを配列に格納しておく
        $error_detail["error_format_birthday"] = true;
    }
}

// CSRFチェック
if (false === is_csrf_token_admin()) {
    // 「CSRFトークンエラー」であることを配列に格納しておく
    $error_detail["error_csrf"] = true;
}

// 確認
//var_dump($error_detail);

// エラーが出たら入力ページに遷移する
if (false === empty($error_detail)) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer'] = $error_detail;

    // 入力値をセッションに入れて持ちまわる
    // XXX 「keyが重複しない」はずなので、加算演算子でOK
    $_SESSION['output_buffer'] += $user_edit_data;

    // 編集ページに遷移する
    header('Location: ./admin_data_update.php?test_form_id=' . rawurlencode($test_form_id));
    exit;
}

// DBハンドルの取得
$dbh = get_dbh();

// INSERT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'UPDATE test_form SET name=:name, post=:post, address=:address, birthday=:birthday, updated=:updated WHERE test_form_id = :test_form_id;';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':test_form_id', $test_form_id, PDO::PARAM_INT);
$pre->bindValue(':name', $user_edit_data['name'], PDO::PARAM_STR);
$pre->bindValue(':post', format_post($user_edit_data['post']), PDO::PARAM_STR);
$pre->bindValue(':address', $user_edit_data['address'], PDO::PARAM_STR);
$pre->bindValue(':birthday', $user_edit_data['birthday'], PDO::PARAM_STR);
$pre->bindValue(':updated', date(DATE_ATOM), PDO::PARAM_STR);

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
  修正しました。<br>
  <br>
  <a href="./admin_data_list.php">一覧に戻る</a>
</body>
</html>

