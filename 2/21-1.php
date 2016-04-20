<?php

// XXX このファイルはUTF-8で書かれています
$s = "サンプルコード\n";

//
$s2 = mb_convert_encoding($s, 'SJIS-win', 'UTF-8');
//$s2 = mb_convert_encoding($s, 'eucJP-win', 'UTF-8');
//$s2 = mb_convert_encoding($s, 'JIS', 'UTF-8');

// ファイルに書きだす
$r = file_put_contents('./21-1.txt', $s2);
var_dump($r);
