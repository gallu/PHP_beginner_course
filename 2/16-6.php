<?php

// continue
for($i = 0; $i < 10; $i ++) {
    // 2で割り切れる数(偶数)なら処理をスキップして次に進む
    if (0 === ($i % 2)) {
        continue;
    }
    // 出力
    echo $i, "<br>\n";
}
//
echo "<br><br>\n"; // 区切り用の改行

// 乱数で９が出たら処理を終了する
while(true) {
    // ０から９の間で乱数を１つ発生させる
    $i = mt_rand(0, 9);

    // 9が出たら終了
    if (9 === $i) {
        break;
    }

    // 出力
    echo $i, "<br>\n";
}
// 終了したことを告げる
echo "fin<br>\n";
