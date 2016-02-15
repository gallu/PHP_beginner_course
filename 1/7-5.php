<?php
date_default_timezone_set('Asia/Tokyo');
$t = strtotime("January 1st, 2016 00:00:00"); // アメリカ式
echo date("Y-m-d H:i:s", $t);
echo "<br>\n";
$t = strtotime("1 January 2016 00:00:00"); // イギリス式
echo date("Y-m-d H:i:s", $t);
echo "<br>\n";
