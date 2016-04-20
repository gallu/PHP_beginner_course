<?php
//
ini_set('display_errors', true);
error_reporting(E_ALL);

// header出力前に、何かbodyを出力する
echo 'test';
for($i = 0; $i < 4096; $i ++) {
    echo '.';
}

// Cookieを設定する
setcookie('test', 'data');

