<?php

/*
 * test_form用 共通関数置き場
 */

// 共通関数のinclude
require_once('common_function.php');

/**
 * 引数で指定された test_form_id を持つ情報１件を取得する
 *
 * 存在しない場合は空配列を返す
 *
 */
function get_test_form($test_form_id) {
    // 最低限程度のエラーチェック
    if ('' === $test_form_id) {
        return array();
    }

    // DBハンドルの取得
    $dbh = get_dbh();

    // SELECT文の作成と発行
    // ------------------------------
    // 準備された文(プリペアドステートメント)の用意
    $sql = 'SELECT * FROM test_form WHERE test_form_id = :test_form_id;';
    $pre = $dbh->prepare($sql);

    // 値のバインド
    $pre->bindValue(':test_form_id', $test_form_id, PDO::PARAM_INT);

    // SQLの実行
    $r = $pre->execute();
    if (false === $r) {
        // XXX 本当はもう少し丁寧なエラーページを出力する
        echo 'システムでエラーが起きました';
        exit;
    }

    // データを取得
    $data = $pre->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($data);
    // 最低限程度のエラーチェック
    if (true === empty($data)) {
        return array();
    }
    // else
    $datum = $data[0]; // 「１件しかでてこない」はずなので、あらかじめ「１件分のデータ」を把握しておく
    //var_dump($datum);

    //
    return $datum;
}
