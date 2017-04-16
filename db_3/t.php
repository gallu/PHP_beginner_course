<?php
// 例：  php t.php form_insert 04
$fn = $argv[1];
$num = (int)$argv[2];

$cmd = sprintf("cp %s_%02d.php %s.php\n", $fn, $num, $fn);
echo $cmd;
`$cmd`;

$cmd = sprintf("git add %s_%02d.php %s.php\n", $fn, $num, $fn);
echo $cmd;
`$cmd`;

