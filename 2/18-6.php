<pre>
<?php

$awk = array(
  'c' => 2,
  'd' => 4,
  'a' => 1,
  'b' => 3,
);
sort($awk);
echo "sort\n";
var_dump($awk);

//
$awk = array(
  'c' => 2,
  'd' => 4,
  'a' => 1,
  'b' => 3,
);
rsort($awk);
echo "\nrsort\n";
var_dump($awk);

//
$awk = array(
  'c' => 2,
  'd' => 4,
  'a' => 1,
  'b' => 3,
);
asort($awk);
echo "\nasort\n";
var_dump($awk);

//
$awk = array(
  'c' => 2,
  'd' => 4,
  'a' => 1,
  'b' => 3,
);
arsort($awk);
echo "\narsort\n";
var_dump($awk);

//
$awk = array(
  'c' => 2,
  'd' => 4,
  'a' => 1,
  'b' => 3,
);
ksort($awk);
echo "\nksort\n";
var_dump($awk);

//
$awk = array(
  'c' => 2,
  'd' => 4,
  'a' => 1,
  'b' => 3,
);
krsort($awk);
echo "\nkrsort\n";
var_dump($awk);

