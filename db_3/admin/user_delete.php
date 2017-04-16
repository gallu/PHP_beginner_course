<?php

/*
 * 管理者削除処理
 */

// 認証処理のinclude
require_once('./auth_full_control.php');

// ユーザ入力情報を保持する配列を準備する
$user_input_data = array();

// 「パラメタの一覧」を把握
$params = array('user_id');
// データを取得する
foreach($params as $p) {
    $user_input_data[$p] = (string)@$_POST[$p];
}
// 確認
//var_dump($user_input_data);

// ユーザ入力のvalidate
// --------------------------------------
// 必須入力のチェック
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

    // XXX 削除処理なので今回は入力値を特に持回らない

    // Listページに遷移する
    header('Location: ./user_list.php');
    exit;
}


// DBハンドルの取得
$dbh = get_dbh();

// INSERT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'DELETE FROM  admin_users WHERE user_id=:user_id;';
$pre = $dbh->prepare($sql);

// 値のバインド
$pre->bindValue(':user_id', $user_input_data['user_id'], PDO::PARAM_STR);

// SQLの実行
$r = $pre->execute();
if (false != $r) {
    // 「削除成功した」メッセージを出力するためのフラグを持ちまわる
    $_SESSION['output_buffer']['delete_success'] = true;
}

// Listページに遷移する
header('Location: ./user_list.php');
