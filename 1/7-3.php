<?php
$t = time(); // エポック秒の取得
date_default_timezone_set('Asia/Tokyo');
echo date('曜日：l(D)', $t);
echo "<br>\n";
echo date('月：F(M)', $t);
echo "<br>\n";
echo date('タイムゾーン：O', $t);

