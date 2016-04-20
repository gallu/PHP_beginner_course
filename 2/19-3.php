<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

// 正しい
function hoge_1234() {
}

// 正しい
function _hoge() {
}

/*
// 正しくない(先頭１文字目に数字はNG)
function 9hoge() {
}

// 正しくない(アンダースコア以外の記号はNG)
function ho-ge() {
}
*/

// 正しい(けどあまり使われていない)
function ほげ() {
}


