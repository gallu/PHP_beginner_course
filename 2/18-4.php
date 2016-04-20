<pre>
<?php

//
$awk = array(
    array(1,2,3),
    array(2,3,4),
    array(4,5,6),

);
var_dump($awk);

// 区切り
echo "\n\n";

//
foreach($awk as $v) {
    var_dump($v);
}

// 区切り
echo "\n\n";

//
foreach($awk as $v) {
    foreach($v as $v2) {
        echo "{$v2} ";
    }
    echo "\n";
}
