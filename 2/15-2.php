<?php

// 全てのエラーを表示させるやり方(PHP5.4.0以降)
ini_set('display_errors', 'on');
error_reporting(E_ALL);

// 全てのエラーを表示させるやり方(PHP5.3.0以前)
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);


// 以下のように書いてもよい
ini_set('display_errors', 'on');
error_reporting(-1); // 仮に将来のバージョンの PHP で新しいレベルと定数が追加されたとしてもすべてのエラーを表示するようになる

