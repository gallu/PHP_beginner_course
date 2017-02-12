<?php

/*
 * XSS対策用のエスケープ処理関数
 */
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
