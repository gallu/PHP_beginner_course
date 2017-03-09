<?php

/*
 * ユーザからのform情報の取得とDBへのINSERT
 */

// ユーザ入力情報の取得
// --------------------------------------
// HTTP responseヘッダを出力する可能性があるので、バッファリングしておく
ob_start();
// セッションの開始
session_start();

// 共通関数のinclude
require_once('common_function.php');
require_once('test_form_data.php');

// 日付関数(date)を使うのでタイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// ユーザ入力情報を保持する配列を準備する
$user_input_data = array();

/*
// データを取得する
$user_input_data['name'] = (string)@$_POST['name'];
$user_input_data['post'] = (string)@$_POST['post'];
$user_input_data['address'] = (string)@$_POST['address'];
$user_input_data['birthday_yy'] = (string)@$_POST['birthday_yy'];
$user_input_data['birthday_mm'] = (string)@$_POST['birthday_mm'];
$user_input_data['birthday_dd'] = (string)@$_POST['birthday_dd'];
*/

// 「パラメタの一覧」を把握
$params = array('name', 'post', 'address', 'birthday_yy', 'birthday_mm', 'birthday_dd');
// データを取得する
foreach($params as $p) {
    $user_input_data[$p] = (string)@$_POST[$p];
}
// 確認
//var_dump($user_input_data);

// ユーザ入力のvalidate
// --------------------------------------

// 基本のエラーチェック
$error_detail = validate_test_form($user_input_data);

// 入力用、追加のエラーチェック
// 必須チェックを実装
$validate_params = array('birthday_yy', 'birthday_mm', 'birthday_dd');
foreach($validate_params as $p) {
    // 空文字(未入力)なら
    if ('' === $user_input_data[$p]) {
        // 「必須情報の未入力エラー」であることを配列に格納しておく
        $error_detail["error_must_{$p}"] = true; // 例えば「名前が未入力」の場合は、key名は「error_must_name」となる
    }
}

// 誕生日
// 初めに、誕生日の年月日を「文字列」から「数値」に変換しておく
$int_params = array('birthday_yy', 'birthday_mm', 'birthday_dd');
foreach($int_params as $p) {
    $user_input_data[$p] = intval($user_input_data[$p]);
    //$user_input_data[$p] = (int)$user_input_data[$p]; // こちらの書き方でもよい
}
// PHPの標準関数を使って日付の妥当性をチェックする
if (false === checkdate($user_input_data['birthday_mm'], $user_input_data['birthday_dd'], $user_input_data['birthday_yy'])) {
    // 「誕生日のフォーマットエラー」であることを配列に格納しておく
    $error_detail["error_format_birthday"] = true;
}

// 確認
//var_dump($error_detail);

// CSRFチェック
if (false === is_csrf_token()) {
    // 「CSRFトークンエラー」であることを配列に格納しておく
    $error_detail["error_csrf"] = true;
}

// エラーが出たら入力ページに遷移する
if (false === empty($error_detail)) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer'] = $error_detail;

    // 入力値をセッションに入れて持ちまわる
    // XXX 「keyが重複しない」はずなので、加算演算子でOK
    $_SESSION['output_buffer'] += $user_input_data;

    // 入力ページに遷移する
    header('Location: ./form_insert.php');
    exit;
}

// DBハンドルの取得
$dbh = get_dbh();

// INSERT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'INSERT INTO test_form(name, post, address, birthday, created, updated)
             VALUES (:name, :post, :address, :birthday, :created, :updated);';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':name', $user_input_data['name'], PDO::PARAM_STR);
$pre->bindValue(':post', $user_input_data['post'], PDO::PARAM_STR);
$pre->bindValue(':address', $user_input_data['address'], PDO::PARAM_STR);
//
$birthday = "{$user_input_data['birthday_yy']}-{$user_input_data['birthday_mm']}-{$user_input_data['birthday_dd']}";
$pre->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$pre->bindValue(':created', date(DATE_ATOM), PDO::PARAM_STR);
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
  入力いただきましてありがとうございました。
</body>
</html>
