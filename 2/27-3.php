<?php
// ヘッダ出力があり得るので、出力バッファ
ob_start();

// CSV用のデータ。本来はDB等から取得することが多い
$data = array(
    array(1, '2nd', 3),
    array('te,st', "te\nst", 'te"st'),
);

// ファイルを開ける
// XXX 「サイズが小さいファイルならメモリに展開する」ために速度的に有利なのでphp://tempを利用。
// XXX 「速度よりもメモリが優先」な場合、コメントアウトしてある「tmpfile()」関数のほうを使うとよい
$fp = fopen('php://temp', 'w+');
//$fp = tmpfile();

// １行づつ書き込む
foreach($data as $datum) {
    $r = fputcsv($fp, $datum);
}

// ファイルの読み位置(ファイルポインタ)を先頭に移動させる
fseek($fp, 0);

// ヘッダを出力する
$filename = '27-3.csv'; // ここは実際には比較的自由に
header('Content-type: application/octet-stream');
header("Content-Disposition: attachment; filename={$filename};");

// CSVの本体を出力する
while($s = fgets($fp)) {
    echo $s;
}

// ファイルを閉じる
fclose($fp);

// 出力バッファを終了させる
ob_end_flush();
