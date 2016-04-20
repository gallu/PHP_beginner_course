<pre>
<?php

// fileをあける
$fp = fopen('./27-1.csv', 'r');

// 読み込む
while(false !== ($row = fgetcsv($fp))) {
    var_dump($row);
}

// fileを閉じる
fclose($fp);
