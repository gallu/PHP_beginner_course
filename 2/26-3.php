<?php

// 基本的に「危険なコード」なので、実際には動かない、概念的なコードのみ記述します
$sql = "SELECT * FROM data WHERE column = '{$_GET['search_word']}' ;";

//
$res = $dbh->query($sql);

/*
$_GET['search_word'] に hoge が入っている場合：想定されている入力
SELECT * FROM data WHERE column = 'hoge' ;


$_GET['search_word'] に '; DELETE FROM data;-- が入っている場合：想定されていない入力
SELECT * FROM data WHERE column = ''; DELETE FROM data;--' ;


$_GET['search_word'] に ';UPDATE users SET password='';-- が入っている場合：想定されていない入力
SELECT * FROM data WHERE column = '';UPDATE users SET password='';--' ;

 */


