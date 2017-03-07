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
