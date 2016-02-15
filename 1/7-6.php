<?php
date_default_timezone_set('Asia/Tokyo');
$t = strtotime("+1 day");
echo date('Y-m-d H:i:s', $t);
echo "<br>\n";
$t = strtotime("next week");
echo date('Y-m-d H:i:s', $t);
