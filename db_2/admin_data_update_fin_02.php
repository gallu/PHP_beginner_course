<?php

/*
 * (管理画面想定)１件のform情報の編集完了処理
 */

// ユーザ入力情報を保持する配列を準備する
$user_edit_data = array();

// 「パラメタの一覧」を把握
$params = array('name', 'post', 'address', 'birthday');
// データを取得する
foreach($params as $p) {
    $user_edit_data[$p] = (string)@$_POST[$p];
}
// 確認
var_dump($user_edit_data);

