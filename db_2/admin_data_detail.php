<?php

/*
 * (管理画面想定)１件のform情報の詳細
 */

// HTTP responseヘッダを出力する可能性があるので、バッファリングしておく
ob_start();

// 共通関数のinclude
require_once('common_function.php');


// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う

// パラメタを受け取る
$test_form_id = (string)@$_GET['test_form_id'];
// 最低限程度のエラーチェック
if ('' === $test_form_id) {
    header('Location: ./admin_data_list.php');
    exit;
}
// 確認
var_dump($test_form_id);
