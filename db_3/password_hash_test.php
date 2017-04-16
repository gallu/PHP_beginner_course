<?php

// password_hash関数
$t_start = microtime(true);
echo password_hash('password', PASSWORD_DEFAULT);
$t_end = microtime(true);
echo "<br>\n";
var_dump($t_end - $t_start);
echo "<br>\n<br>\n";

// password_hash関数:costを重くしてみる(デフォルトだと10)
$t_start = microtime(true);
echo password_hash('password', PASSWORD_DEFAULT, array('cost' => 14));
$t_end = microtime(true);
echo "<br>\n";
var_dump($t_end - $t_start);
echo "<br>\n<br>\n";

// md5関数
$t_start = microtime(true);
echo md5('password');
$t_end = microtime(true);
echo "<br>\n";
var_dump($t_end - $t_start);
var_dump($t_end);
var_dump($t_start);
echo "<br>\n<br>\n";

// sha-1関数
$t_start = microtime(true);
echo sha1('password');
$t_end = microtime(true);
echo "<br>\n";
var_dump($t_end - $t_start);
var_dump($t_end);
var_dump($t_start);
echo "<br>\n<br>\n";

// sha-256関数
$t_start = microtime(true);
echo hash('sha256', 'password');
$t_end = microtime(true);
echo "<br>\n";
var_dump($t_end - $t_start);
var_dump($t_end);
var_dump($t_start);
echo "<br>\n<br>\n";

