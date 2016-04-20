<?php

// 誤差許容範囲
$allowable_error_range = 0.000001;

// 比較する二つの値
$f1 = 0.1 + 0.2;
$f2 = 0.3;

// 駄目な比較方法
if ($f1 === $f2) {
  echo "equal\n";
} else {
  echo "no equal\n";
}

// 誤差を考えた比較方法
// 二つの値の差分を取得
$f = $f1 - $f2;
// 差分の絶対値を取得
$f = abs($f);
// 差分は「許容範囲内」なら($fの値が誤差許容範囲以下なら)一致していると見なす
if ($f <= $allowable_error_range) {
  echo "equal\n";
} else {
  echo "no equal\n";
}

// 通常は、まとめて、以下のように記述する
if (abs($f1 - $f2) <= $allowable_error_range) {
  echo "equal\n";
} else {
  echo "no equal\n";
}
