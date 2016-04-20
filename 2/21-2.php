<pre>
<?php

function dump_string($s)
{
  $len = strlen($s);
  $ret = '(';
  for($i = 0; $i < $len; $i ++) {
    $ret .= sprintf("(%02x)", ord($s[$i]));
  }
  $ret .= ')';
  return $ret;
}

// テスト
$s = 'あ';
echo dump_string($s), "\n";
//
$s2 = mb_convert_encoding($s, 'SJIS-win', 'UTF-8');
echo dump_string($s2), "\n";
//
$s2 = mb_convert_encoding($s, 'eucJP-win', 'UTF-8');
echo dump_string($s2), "\n";
//
$s2 = mb_convert_encoding($s, 'JIS', 'UTF-8');
echo dump_string($s2), "\n";


