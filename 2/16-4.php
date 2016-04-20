<?php

for($i = 1; $i <= 9; $i ++) {
    for($j = 1; $j <= 9; $j ++) {
        $product = $i * $j;
        echo $i , ' * ' , $j , ' = ' , $product , '　';
    }
    echo "<br>\n";
}
