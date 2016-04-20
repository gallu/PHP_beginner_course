<pre>
<?php

//
$i = 65;
$f = 1.23456789;
$s = 'abc';

// 桁あわせ
printf("%6d\n", $i);
// 0パディング
printf("%06d\n", $i);
// 符号付
printf("%+d\n", $i);

// 小数点
printf("%f\n", $f);
// 精度指定小数点
printf("%.4f\n", $f);

// 文字列
printf("%s\n", $s);
// １文字(数値をASCIIコードとして変換)
printf("%c\n", $i);
// 文字幅指定
printf("%16s\n", $s);
printf("%016s\n", $s);
