<?php

/*
 * ログイン処理
 */

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');

// 日付関数(date)を(後で)使うのでタイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// ユーザ入力情報を保持する配列を準備する
$user_input_data = array();
// エラー情報を保持する配列を準備する
$error_detail = array();

// 「パラメタの一覧」を把握
$params = array('email', 'pass');
// データを取得する ＋ 必須入力のvalidate
foreach($params as $p) {
    $user_input_data[$p] = (string)@$_POST[$p];
    if ('' === $user_input_data[$p]) {
        $error_detail['error_must_' . $p] = true;
    }
}
// 確認
//var_dump($user_input_data);

// エラーが出たら入力ページに遷移する
if (false === empty($error_detail)) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer'] = $error_detail;
    // メアドは保持する
    $_SESSION['output_buffer']['email'] = $user_input_data['email'];

    // 入力ページに遷移する
    header('Location: ./index.php');
    exit;
}

// 比較用のパスワード情報取得 ＆ パスワード比較
// 判定用フラグ
$login_flg = false;

// DBハンドルの取得
$dbh = get_dbh();

// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM users WHERE email=:email;';
$pre = $dbh->prepare($sql);
// 値のバインド
$pre->bindValue(':email', $user_input_data['email'], PDO::PARAM_STR);
// SQLの実行
$r = $pre->execute();
if (false === $r) {
    // XXX 本当はもう少し丁寧なエラーページを出力する
    echo 'システムでエラーが起きました';
    exit;
}
// SELECTした内容の取得
// XXX emailは UNIQUE制約付き なので、０件もしくは１件なので、fetchAllではなくfetchでの取得で事足りる
$datum = $pre->fetch(PDO::FETCH_ASSOC);
//var_dump($datum);

// emailが存在していたら、作業を続行する
if (false === empty($datum)) {
    // ロックテーブルを読み込んで情報を把握する
    $sql = 'SELECT * FROM user_login_lock WHERE user_id=:user_id;';
    $pre = $dbh->prepare($sql);
    // 値のバインド
    $pre->bindValue(':user_id', $datum['user_id'], PDO::PARAM_STR);
    // SQLの実行
    $r = $pre->execute(); // XXX
    // SELECTした内容の取得
    $lock_datum = $pre->fetch(PDO::FETCH_ASSOC);
    // とれてなければデフォルトの情報を入れる
    if (false === $lock_datum) {
        //
        $lock_datum['user_id'] = $datum['user_id'];
        $lock_datum['error_count'] = 0;
        $lock_datum['lock_time'] = '0000-00-00 00:00:00';
    }

    // 現在ロック中なら、時刻を確認
    if ('0000-00-00 00:00:00' !== $lock_datum['lock_time']) {
        // ロック時間が「現在以降」なら、ロックを一端外す
        if (time() > strtotime($lock_datum['lock_time'])) {
            $lock_datum['lock_time'] = '0000-00-00 00:00:00';
            $lock_datum['error_count'] = 0;
        }
    }

    // 最終的に「ロックされていなければ」以下の処理をする
    if ('0000-00-00 00:00:00' === $lock_datum['lock_time']) {
        // パスワードを比較して、その結果を代入する
        if (true === password_verify($user_input_data['pass'], $datum['pass'])) {
            // countのリセット
            $lock_datum['error_count'] = 0;
            // ログインフラグを立てる
            $login_flg = true;
        } else {
            // countのいんくり
            ++ $lock_datum['error_count'];
            // 一定回数(一端、５回)連続でエラーなら、ロックを入れる(一端、１時間)
            if (5 <= $lock_datum['error_count']) {
                $lock_datum['lock_time'] = date('Y-m-d H:i:s', time() + 3600);
                // XXX ここで「ユーザメールに"ログインロックがされた。心当たりがなければ運用に連絡して欲しい"的なmailを投げる等の処理を入れるのも有効
            }
        }
    }

    // ロックテーブルに情報を入れる
    // XXX いわゆるupsertにはREPLACEとINSERT ON DUPLICATE KEY UPDATEがあるが、今回は「全てのカラムを入れる」ので、SQL文がシンプルなREPLACEで対応
    $sql = 'REPLACE INTO user_login_lock(user_id, error_count, lock_time) VALUES(:user_id, :error_count, :lock_time);';
    $pre = $dbh->prepare($sql);
    // 値のバインド
    $pre->bindValue(':user_id', $lock_datum['user_id'], PDO::PARAM_STR);
    $pre->bindValue(':error_count', $lock_datum['error_count'], PDO::PARAM_INT);
    $pre->bindValue(':lock_time', $lock_datum['lock_time'], PDO::PARAM_STR);
    // SQLの実行
    $r = $pre->execute(); // XXX
}
//var_dump($login_flg);

// 最終的に「ログイン情報に不備がある」場合は、エラーとして突き返す
// XXX ロジック的にあえて「emailのエラーなのかパスワードのエラーなのか」判別できないようにしてある：不必要情報への対策
// エラーが出たら入力ページに遷移する
if (false === $login_flg) {
    // エラー情報をセッションに入れて持ちまわる
    $_SESSION['output_buffer']['error_invalid_login'] = true;
    // メアドは保持する
    $_SESSION['output_buffer']['email'] = $user_input_data['email'];

    // 入力ページに遷移する
    header('Location: ./index.php');
    exit;
}

// XXX ここまで来たら「適切な情報でログインができている」
//echo 'ログインできました';

// セッションIDを張り替える：
session_regenerate_id(true);
// 「ログインできている」という情報をセッション内に格納する
$_SESSION['auth']['user_id'] = $datum['user_id'];
$_SESSION['auth']['name'] = $datum['name'];

// TopPage(認証後トップページ)に遷移させる
header('Location: ./top.php');

