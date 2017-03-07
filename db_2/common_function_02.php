<?php

/*
 * 共通関数置き場
 */

// XSS対策用エスケープ関数
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// 「数値の0なら空文字を返す」を追加したXSS対策用エスケープ関数
function h_digit($d) {
    if (0 === $d) {
        return '';
    }
    // else
    return h((string)$d);
}


// CSRF用共通関数
// ----------------------------
// tokenの作成とセッションへの設定
function create_csrf_token() {

    // CSRF用のトークンの作成と設定
    $csrf_token = '';
    try {
        // XXX random_bytesはPHP7以降の関数だが、PHP5.2以降で使えるユーザランド実装( https://github.com/paragonie/random_compat )が存在する
        if(function_exists('random_bytes')) {
            $csrf_token = hash('sha512', random_bytes(128));
        } else if (is_readable('/dev/urandom')) {
            $csrf_token = hash('sha512', file_get_contents('/dev/urandom', false, NULL, 0, 128), false);
        } else if(function_exists('openssl_random_pseudo_bytes')) {
            $csrf_token = hash('sha512', openssl_random_pseudo_bytes(128));
        }
    } catch (Exception $e) {
        ; // XXX 後でまとめてエラーチェックするので一端ここでは未処理
    }
    if ('' === $csrf_token) {
        echo 'CSRFトークンが作成できないので終了します';
        exit; // XXX
    }

    // CSRFトークンは5個まで(で後で追加するので、ここでは4個以下に)
    while (5 <= count(@$_SESSION['front']['csrf_token'])) {
        array_shift($_SESSION['front']['csrf_token']);
    }

    // セッションに格納
    $_SESSION['front']['csrf_token'][$csrf_token] = time();

    //
    return $csrf_token;
}

// tokenのチェック
function is_csrf_token() {

    // CSRFトークンを把握
    $post_csrf_token = (string)@$_POST['csrf_token'];

    // セッションの中に「送られてきたトークン」が存在しなければ、false
    if (false === isset($_SESSION['front']['csrf_token'][$post_csrf_token])) {
        return false;
    }

    // 寿命を把握して
    $ttl = $_SESSION['front']['csrf_token'][$post_csrf_token];
    // 先にトークンは削除(使い捨てなので)
    unset($_SESSION['front']['csrf_token'][$post_csrf_token]);
    // 寿命チェック(5分以内)
    if (time() >=  $ttl + 300) {
        return false;
    }

    // すべてのチェックでOKだったのでチェック成功
    return true;
}
