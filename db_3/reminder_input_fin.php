<?php

/*
 * 「パスワード再設定用Pageへの遷移URL」の作成とmail送信
 */

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');
require_once('user_data.php');

// 日付関数(date)を(後で)使うのでタイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

//
$error_detail = array();

// ユーザ入力情報の取得
// --------------------------------------
$email = (string)@$_POST['email'];
if ('' === $email) {
    $error_detail["error_must_email"] = true;
}

// CSRFチェック
if (false === is_csrf_token()) {
    // 「CSRFトークンエラー」であることを配列に格納しておく
    $error_detail["error_csrf"] = true;
}

// エラーが出たら入力ページに遷移する
if (false === empty($error_detail)) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer'] = $error_detail;

    // 入力ページに遷移する
    header('Location: ./reminder_input.php');
    exit;
}

// DBハンドルの取得
$dbh = get_dbh();

// 「入力されたemailの存在」を確認する
// XXX 「存在しないemail」であっても、それは一切エラー表示しないこと！！

// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM users WHERE email=:email;';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':email', $email, PDO::PARAM_STR);
// SQLの実行
$r = $pre->execute();
if (false === $r) {
    // XXX 本当はもう少し丁寧なエラーページを出力する
    echo 'システムでエラーが起きました';
    exit;
}
// SELECTした内容の取得
$datum = $pre->fetch(PDO::FETCH_ASSOC);
//var_dump($datum);

// emailが存在していたら、作業を続行する
if (false !== $datum) {
    // トークンを作成する
    // XXX 実際には、common_function.phpの_create_csrf_token()関数の「トークン作成部分」を切り出して共通化するとよりよいです
    $token = hash('sha512', openssl_random_pseudo_bytes(128));
//var_dump($token);
    // トークンおよびユーザIDを「トークン管理テーブル」に入れる
    $sql = 'INSERT INTO reminder_token(token, user_id, created) VALUES(:token, :user_id, :created);';
    $pre = $dbh->prepare($sql);
    // 値のバインド
    $pre->bindValue(':token', $token, PDO::PARAM_STR);
    $pre->bindValue(':user_id', $datum['user_id'], PDO::PARAM_INT);
    $pre->bindValue(':created', date(DATE_ATOM), PDO::PARAM_STR);
    // SQLの実行
    $r = $pre->execute();
    if (false === $r) {
        // XXX 本当はもう少し丁寧なエラーページを出力する
        // XXX 上述の「selectでエラー」と同じメッセージを出す：不必要情報の防止のため
        echo 'システムでエラーが起きました';
        exit;
    }

    // mail用の本文を作成する
    $mail_body = <<<EOD
以下のURLに、１時間以内にアクセスして、パスワードを再設定してください。
http://localhost/db_3/reminder_password_input.php?t={$token}
EOD;
//var_dump($mail_body); // XXX このvar_dumpはセキュリティ的には危険なので、確認が終わったら確実に消す事！！

    // mailを送信する
    // XXX mail送信処理は一端オミットします
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
  入力いただいたemailにメールを送信しました。<br>
  もし[一定時間(30分とか60分とか)]経過してもemailが届かない場合、emailの入力ミスの可能性がありますので、お手数ですが再度操作きをお願いいたします。
</body>
</html>
