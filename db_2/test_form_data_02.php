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


/**
 * 与えられた配列をvalidateする
 *
 * validateがすべてOKなら空配列、NGな項目がある場合はerror_detailに値が入った配列を返す
 *
 */
function validate_test_form($datum) {
    // エラー情報の詳細を入れるための配列を用意する
    $error_detail = array();

    // 必須チェックを実装
    $validate_params = array('name', 'post', 'address');
    foreach($validate_params as $p) {
        // 空文字(未入力)なら
        if ('' === $datum[$p]) {
            // 「必須情報の未入力エラー」であることを配列に格納しておく
            $error_detail["error_must_{$p}"] = true; // 例えば「名前が未入力」の場合は、key名は「error_must_name」となる
        }
    }
    // 型チェックを実装
    // 郵便番号
    /*
        \A: 行頭
        [0-9]{3}： [0から9までのいずれかの文字]を３回繰り返す
        [- ]?： [ハイフン、スペースのいずれかの文字]を０回ないし１回繰り返す
        [0-9]{4}： [0から9までのいずれかの文字]を４回繰り返す
        \z: 行末
    */
    if (1 !== preg_match('/\A[0-9]{3}[- ]?[0-9]{4}\z/', $datum['post'])) {
        // 「郵便番号のフォーマットエラー」であることを配列に格納しておく
        $error_detail["error_format_post"] = true;
    }

    //
    return $error_detail;
}

