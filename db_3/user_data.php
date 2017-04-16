<?php

/*
 * user用 共通関数置き場
 */

// 共通関数のinclude
require_once('common_function.php');


/**
 * 与えられた配列をvalidateする
 *
 * validateがすべてOKなら空配列、NGな項目がある場合はerror_detailに値が入った配列を返す
 *
 */
function validate_user($datum) {
    // エラー情報の詳細を入れるための配列を用意する
    $error_detail = array();

    // 必須チェックを実装
    $validate_params = array('name', 'email');
    foreach($validate_params as $p) {
        // 空文字(未入力)なら
        if ('' === $datum[$p]) {
            // 「必須情報の未入力エラー」であることを配列に格納しておく
            $error_detail["error_must_{$p}"] = true; // 例えば「名前が未入力」の場合は、key名は「error_must_name」となる
        }
    }
    // 型チェックを実装
    // XXX emailのvalidateは、色々と議論の多いところです
    // XXX 「正規表現でチェック」という記述は正直「そのほとんどに(場合によっては致命的な)問題がある事が多い」ので、注意しましょう
    // XXX 本プログラムでは「古いころのガラケーの"RFC違反メールをはじいてしまう"」という問題点がありますが、PHPの関数機能を使います
    if (false === filter_var($datum['email'], FILTER_VALIDATE_EMAIL)) {
        $error_detail['error_format_email'] = true;
    }

    //
    return $error_detail;
}


