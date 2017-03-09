<?php

/*
 * (管理画面想定)１件のform情報の削除
 */


// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う

// パラメタを受け取る
// XXX エラーチェックは get_test_form() 関数側でやっているのでここではオミット
$test_form_id = (string)@$_GET['test_form_id'];
// 確認
var_dump($test_form_id);
