<?php

/*
 * パスワード再設定処理
 */

// ユーザ入力情報の取得
// --------------------------------------
// HTTP responseヘッダを出力する可能性があるので、バッファリングしておく
ob_start();
// セッションの開始
session_start();

// 共通関数のinclude
require_once('common_function.php');
require_once('user_data.php');

// 日付関数(date)を(後で)使うのでタイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// ユーザ入力情報を保持する配列を準備する
$user_input_data = array();

// 「パラメタの一覧」を把握
$params = array('pass_1', 'pass_2', 't');
// データを取得する
foreach($params as $p) {
    $user_input_data[$p] = (string)@$_POST[$p];
}
// 確認
//var_dump($user_input_data);

// ユーザ入力のvalidate
// --------------------------------------

// パスワードチェック
$error_detail = validate_user_password($user_input_data);

// CSRFチェック
if (false === is_csrf_token()) {
    // 「CSRFトークンエラー」であることを配列に格納しておく
    $error_detail["error_csrf"] = true;
}

// エラーが出たら入力ページに遷移する
if (false === empty($error_detail)) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer'] = $error_detail;

    // XXX 入力値は、今回は「パスワードのみ」なので持ちまわらない

    // 入力ページに遷移する
    header('Location: ./reminder_password_input.php?t=' . rawurlencode($user_input_data['t']));
    exit;
}


// DBハンドルの取得
$dbh = get_dbh();

// tokenチェック
$sql = 'SELECT * FROM reminder_token WHERE token=:token';
$pre = $dbh->prepare($sql);
// 値のバインド
$pre->bindValue(':token', $user_input_data['t'], PDO::PARAM_STR);
// SQLの実行
$r = $pre->execute();
if (false === $r) {
    // XXX 本当はもう少し丁寧なエラーページを出力する
    // XXX ただし「emailのUNIQUE制約エラー」は、丁寧に表示すると「不必要情報」の脆弱性になるので注意！！
    echo 'システムでエラーが起きました';
    exit;
}
// データの取得(０件または１件なのが明確なので、fetchで)
$datum = $pre->fetch(PDO::FETCH_ASSOC);
if (true === empty($datum)) {
    // XXX 本当はもう少し丁寧なエラーページを出力する
    echo '無効なトークンです';
    exit;
}

// この時点で、トークンの有効無効にかかわらず「このトークンは不要(使い終わったかもしくは使えない)」なので、とっとと削除しておく
$sql = 'DELETE FROM reminder_token WHERE token=:token';
$pre = $dbh->prepare($sql);
// 値のバインド
$pre->bindValue(':token', $user_input_data['t'], PDO::PARAM_STR);
// SQLの実行
$r = $pre->execute(); // XXX エラーチェックは一端オミット


// 有効時間をチェックする
if (time() > (strtotime($datum['created']) + 3600)) {
    // XXX 本当はもう少し丁寧なエラーページを出力する
    echo 'トークンの有効時間(１時間)を超えています。お手数ですが、改めて「<a href="./reminder_input.php">トークンの発行</a>」から操作をお願いいたします。';
    exit;
}

// UPDATE文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'UPDATE users SET pass=:pass, updated=:updated WHERE user_id=:user_id;';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':user_id', $datum['user_id'], PDO::PARAM_STR);
// パスワードは「password_hash関数」を用いる：絶対に、何があっても「そのまま(平文で)」入れないこと！！
$pre->bindValue(':pass', user_pass_hash($user_input_data['pass_1']), PDO::PARAM_STR);
// 日付(MySQLのバージョンが高ければ"DEFAULT CURRENT_TIMESTAMP"に頼る、という方法も一つの選択肢)
$pre->bindValue(':updated', date(DATE_ATOM), PDO::PARAM_STR);

// SQLの実行
$r = $pre->execute();
if (false === $r) {
    // XXX 本当はもう少し丁寧なエラーページを出力する
    // XXX ただし「emailのUNIQUE制約エラー」は、丁寧に表示すると「不必要情報」の脆弱性になるので注意！！
    echo 'システムでエラーが起きました';
    exit;
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
  パスワードを変更しました。
</body>
</html>

