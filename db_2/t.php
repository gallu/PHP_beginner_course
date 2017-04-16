<?php
// 例：  php t.php form_insert.php 4
$fn = $argv[1];
$num = (int)$argv[2];

list($a, $b) = explode('.', $fn);
for($i = 0; $i < $num; ++$i) {
  $j = $i + 1;
  $next = sprintf("%s_%02d.%s", $a, $j, $b);
  echo "git add {$next}\n";
  echo "cp {$next} {$fn}\n";
  echo "git add {$fn}\n";
  echo "git commit {$next} {$fn} -m \"{$fn} ";
  printf("%02d -> %02d\"\n", $i, $j);
  echo "\n";
}
