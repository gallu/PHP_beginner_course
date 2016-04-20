<pre>
<?php

//
echo "trim\n";
$s = " \t test\n";
var_dump($s);
$s2 = trim($s);
var_dump($s2);

// 区切り
echo "\n\n";

//
echo "strtoupper, strtolower, ucfirst, ucwords\n";
$s = 'All in the golden afternoon Full leisurely we glide;';
var_dump($s);
//
$s2 = strtoupper($s);
var_dump($s2);
//
$s2 = strtolower($s);
var_dump($s2);
//
$s2 = ucfirst($s);
var_dump($s2);
//
$s2 = ucwords($s);
var_dump($s2);

// 区切り
echo "\n\n";

// substr
echo "substr\n";
//
$s2 = substr($s, 0, 10); // 0文字目から10文字
var_dump($s2);
//
$s2 = substr($s, 10); // 10文字目から文字列の最後まで
var_dump($s2);
//
$s2 = substr($s, -10); // 「後ろから数えて10文字目」から文字列の最後まで
var_dump($s2);
//
$s2 = substr($s, -10, 3); // 「後ろから数えて10文字目」から3文字
var_dump($s2);
//
$s2 = substr($s, -10, -3); // 「後ろから数えて10文字目」から「後ろから数えて3文字目」まで
var_dump($s2);

// 区切り
echo "\n\n";

//str_replace
echo "str_replace\n";
//
$s2 = str_replace('afternoon', 'evening', $s);
var_dump($s2);
//
//
$s2 = str_replace(array('afternoon', 'golden') , array('evening', 'silver'), $s);
var_dump($s2);

