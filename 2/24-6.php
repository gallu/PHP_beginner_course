<pre>
<?php

//
$awk = 'string';

//
ob_start();
var_dump($awk); // ここでは出力されず、バッファに出力データが入る
$s = ob_get_contents(); // バッファの内容を取り出す
ob_end_clean(); // バッファの内容を消して、出力バッファリングを終了する

//
echo "var_dumpで得られた文字列は\n\n{$s}\n\nです。\n";


