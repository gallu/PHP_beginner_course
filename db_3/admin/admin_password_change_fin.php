<?php

/*
 * 管理者パスワード変更処理
 *
 * XXX 処理的には「９割方、front_password_change_fin.phpと似ている」ので、共通化をしてみるのもよい学習になります
 */

// 認証処理のinclude
require_once('./auth_full_control.php');

// validate_user_password用
// XXX 厳密には「ユーザ用」なのだが、実際の処理は共通なので、一端、流用する。必要に応じて「別のファイル(やclass)」に記述しなおす
require_once('../user_data.php');

// 日付関数(date)を(後で)使うのでタイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// ユーザ入力情報を保持する配列を準備する
$user_input_data = array();

// 「パラメタの一覧」を把握
$params = array('pass_1', 'pass_2', 'user_id');
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

// 必須入力のチェック
// XXX pass_1とpass_2のチェックが重複しているが、一端気にしない
foreach($params as $p) {
    // 空文字(未入力)なら
    if ('' === $user_input_data[$p]) {
        // 「必須情報の未入力エラー」であることを配列に格納しておく
        $error_detail["error_must_{$p}"] = true; // 例えば「名前が未入力」の場合は、key名は「error_must_name」となる
    }
}

// CSRFチェック
if (false === is_csrf_token_admin()) {
    // 「CSRFトークンエラー」であることを配列に格納しておく
    $error_detail["error_csrf"] = true;
}

// エラーが出たら入力ページに遷移する
if (false === empty($error_detail)) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer'] = $error_detail;

    // 入力値も持ちまわる
    $_SESSION['output_buffer'] += $user_input_data;

    // 入力ページに遷移する
    header('Location: ./admin_password_change.php?user_id=' . rawurlencode($user_input_data['user_id']));
    exit;
}


// DBハンドルの取得
$dbh = get_dbh();

// UPDATE文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'UPDATE admin_users SET pass=:pass, updated=:updated WHERE user_id=:user_id;';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':user_id', $user_input_data['user_id'], PDO::PARAM_STR);
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

// 影響行の確認
// update文によって作用した行数が０なら「該当がない」ので、エラーを返す
// XXX emailカラムは UNIQUE制約 がついているので、２行以上の作用はない前提
if (1 !== $pre->rowCount()) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer']['error_invalid_user_id'] = true;

    // 入力値も持ちまわる
    $_SESSION['output_buffer'] += $user_input_data;

    // 入力ページに遷移する
    header('Location: ./admin_password_change.php?user_id=' . rawurlencode($user_input_data['user_id']));
    exit;
}

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座上級 管理画面</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">

  <a href="./top.php">topに戻る</a><br>

  <h1>管理者パスワード変更</h1>
    パスワードを変更しました。
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
