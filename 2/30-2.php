<?php

// ファイル名を取得
$file_name = (string)@$_GET['fn'];
if ('' === $file_name) {
    echo 'ファイル名が指定されていません';
    return ;
}

// 許可されたものの一覧表（第一種ホワイトリスト）でパラメタをチェック
// XXX 配列の値にファイル名を入れてin_arrayで検索してもよいが、添え字にファイル名を入れてissetのほうが高速で効率がよいのでそのように
// XXX 「別ファイルに記述」する事も多いが、今回はサンプルコードなので、１コード完結で
$white_list = array (
    '29-1.php' => 1,
    '29-2.php' => 1,
    '29-3.php' => 1,
    '29-4.php' => 1,
    '29-5.php' => 1,
);

if (false === isset($white_list[$file_name])) {
    echo '不適切なファイル名です';
    return ;
}


// ファイルの情報を取得
$s = file_get_contents("./{$file_name}");

// ファイルの出力
echo $s;

// クラック(出来ない)例
// http://localhost/30-2.php?fn=../php/php.ini

