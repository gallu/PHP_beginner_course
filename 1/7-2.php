<?php
// タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// エポック秒の取得
$t = time();
$date_string = date('Y/m/d H:i:s', $t);
echo $date_string; // 表示
