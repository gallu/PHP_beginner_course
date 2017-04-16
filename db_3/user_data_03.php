<?php

/*
 * user用 共通関数置き場
 */

// 共通関数のinclude
require_once('common_function.php');

/**
 * ユーザパスワードをハッシュ化する
 *
 * XXX 二か所で使うので、共通化しておく
 */
function user_pass_hash($pass) {
    return password_hash($pass, PASSWORD_DEFAULT);
}

/**
 * 与えられた配列をvalidateする:パスワード情報のみ
 *
 * validateがすべてOKなら空配列、NGな項目がある場合はerror_detailに値が入った配列を返す
 *
 */
function validate_user_password($datum) {
    // エラー情報の詳細を入れるための配列を用意する
    $error_detail = array();

    // 必須チェックを実装
    $validate_params = array('pass_1', 'pass_2');
    foreach($validate_params as $p) {
        // 空文字(未入力)なら
        if ('' === $datum[$p]) {
            // 「必須情報の未入力エラー」であることを配列に格納しておく
            $error_detail["error_must_{$p}"] = true; // 例えば「名前が未入力」の場合は、key名は「error_must_name」となる
        }
    }

    // パスワードの長さチェック
    // XXX 「最低ｎ文字」については、「最低何文字にするか」を含めて色々あるので、あえてオミットしています。頑張れそうであれば、自力で追加してみましょう
    // XXX 最大長については「password_hash()関数の仕様」があるので、72文字を超える場合はエラーとします
    if (72 < strlen($datum['pass_1'])) {
        $error_detail['error_toolong_pass_1'] = true;
    }

    // パスワードとパスワード(再)の一致チェック
    if ($datum['pass_1'] !== $datum['pass_2']) {
        $error_detail['error_invalid_pass'] = true;
    }

    //
    return $error_detail;
}

/**
 * 与えられた配列をvalidateする
 *
 * validateがすべてOKなら空配列、NGな項目がある場合はerror_detailに値が入った配列を返す
 *
 */
function validate_user($datum) {
    // 先にパスワードのvalidateを行う
    $error_detail = validate_user_password($datum);

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


