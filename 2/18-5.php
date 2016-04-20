<pre>
<?php

//
$awk = array(1,2,3);

// 数字keyで後ろに追加する場合の方法
$awk[count($awk)] = 4;
var_dump($awk);

// こう書いてもよい
$awk[] = 5;
var_dump($awk);

// hash配列(文字key)ならこのように書く
$awk['test'] = 100;
var_dump($awk);

// １keyの情報を削除
unset($awk[0]);
var_dump($awk);

