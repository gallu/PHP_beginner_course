<pre>
<?php

// XXX PHP5.6.0 以降で(内部)エンコーディングがUTF-8なら以下を設定しておくと楽
//ini_set('default_charset', 'UTF-8');

//
echo "mb_strlen\n";
$s = 'あ';
echo strlen($s), "\n";
echo mb_strlen($s, 'UTF-8'), "\n";
//echo mb_strlen($s), "\n";
echo mb_strwidth($s, 'UTF-8'), "\n";
//echo mb_strwidth($s), "\n";

// 区切り
echo "\n";

//
echo "mb_substr\n";
$s = 'あいうえお';
$s2 = substr($s, 2);
echo "{$s2}\n";
$s2 = mb_substr($s, 2, null, 'UTF-8');
//$s2 = mb_substr($s, 2);
echo "{$s2}\n";
// 半角が混ざっても問題なく動く例
$s = 'あabcいうえお';
$s2 = mb_substr($s, 2, null, 'UTF-8');
//$s2 = mb_substr($s, 2);
echo "{$s2}\n";

// 区切り
echo "\n";

//
echo "mb_strpos\n";
$s = 'あabcいうえお';
$r = strpos($s, 'う');
echo "{$r}\n";
$r = mb_strpos($s, 'う', 0, 'UTF-8');
//$r = mb_strpos($s, 'う');
echo "{$r}\n";

// 区切り
echo "\n";

//
echo "mb_strtolower, mb_strtoupper\n";
$s = 'abcABCａｂｃＡＢＣ';
$s2 = strtolower($s);
echo "{$s2}\n";
$s2 = mb_strtolower($s, 'UTF-8');
//$s2 = mb_strtolower($s);
echo "{$s2}\n";
$s2 = strtoupper($s);
echo "{$s2}\n";
$s2 = mb_strtoupper($s, 'UTF-8');
//$s2 = mb_strtoupper($s);
echo "{$s2}\n";

