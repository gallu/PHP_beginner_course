<?php

/*
 * 管理者登録処理
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
$params = array('user_id', 'name', 'role', 'pass_1', 'pass_2');
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
// roleは、おおざっぱに値をそろえておく(0-2の間のみを許容、なので)
$user_input_data['role'] = abs($user_input_data['role']) % 3;

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
    header('Location: ./register.php');
    exit;
}


// DBハンドルの取得
$dbh = get_dbh();

// INSERT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'INSERT INTO admin_users(user_id, name, pass, role, created, updated) VALUES(:user_id, :name, :pass, :role, :created, :updated);';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':user_id', $user_input_data['user_id'], PDO::PARAM_STR);
$pre->bindValue(':name', $user_input_data['name'], PDO::PARAM_STR);
$pre->bindValue(':role', (int)$user_input_data['role'], PDO::PARAM_INT);
// パスワードは「password_hash関数」を用いる：絶対に、何があっても「そのまま(平文で)」入れないこと！！
$pre->bindValue(':pass', user_pass_hash($user_input_data['pass_1']), PDO::PARAM_STR);
// 日付(MySQLのバージョンが高ければ"DEFAULT CURRENT_TIMESTAMP"に頼る、という方法も一つの選択肢)
$pre->bindValue(':created', date(DATE_ATOM), PDO::PARAM_STR);
$pre->bindValue(':updated', date(DATE_ATOM), PDO::PARAM_STR);

// SQLの実行
$r = $pre->execute();
if (false === $r) {
    // 「Duplicate entry 'user_id' for key 'PRIMARY'」なら、入力画面に突き返す：普通に起きうるエラーなので
    $e = $pre->errorInfo();
//var_dump($e);
    if (0 === strncmp($e[2], 'Duplicate entry', strlen('Duplicate entry'))) {
        // エラー情報をセッションに入れて持ちまわる
        $_SESSION['output_buffer']['error_overlap_user_id'] = true;
        // 入力値も持ちまわる
        $_SESSION['output_buffer'] += $user_input_data;
        // 入力ページに遷移する
        header('Location: ./register.php');
        exit;
    }
    // else
    // XXX 本当はもう少し丁寧なエラーページを出力する
    // XXX ただし「emailのUNIQUE制約エラー」は、丁寧に表示すると「不必要情報」の脆弱性になるので注意！！
    echo 'システムでエラーが起きました';
    exit;
}

// 「登録した」メッセージを出力するためのフラグを持ちまわる
$_SESSION['output_buffer']['register_success'] = true;

// Listページに遷移する
header('Location: ./user_list.php');
