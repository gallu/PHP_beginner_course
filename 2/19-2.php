<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

function hoge() {
}

// 二重定義でエラーになる！
function Hoge() {
}
