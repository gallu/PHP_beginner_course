<?php

// CSV用のデータ。本来はDB等から取得することが多い
$data = array(
    array(1, '2nd', 3),
    array('te,st', "te\nst", 'te"st'),
);

// ファイルを開ける
$fp = fopen('./27-2.csv', 'w');

// １行づつ書き込む
foreach($data as $datum) {
    $r = fputcsv($fp, $datum);
    var_dump($r);
}

// ファイルを閉じる
fclose($fp);

