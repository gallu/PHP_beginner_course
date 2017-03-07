<?php

/*
 * ユーザからのform情報の取得とDBへのINSERT
 */

// ユーザ入力情報の取得
// --------------------------------------

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
//
$error_flg = false;

// 必須チェックを実装
$validate_params = array('name', 'post', 'address', 'birthday_yy', 'birthday_mm', 'birthday_dd');
foreach($validate_params as $p) {
    // 空文字(未入力)なら
    if ('' === $user_input_data[$p]) {
        // エラーフラグを立てる
        $error_flg = true;
    }
}
// 確認
var_dump($error_flg);


