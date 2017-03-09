<?php

/*
 * (管理画面想定)１件のform情報の編集完了処理
 */

// 共通関数のinclude
require_once('test_form_data.php');

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

// 確認
var_dump($error_detail);

