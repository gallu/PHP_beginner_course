<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

// global変数
$a = 10;

function hoge() {
  var_dump($a); // function内なので、globalな$aは参照できない
}

//
hoge();
