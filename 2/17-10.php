<pre>
<?php
//
$s = 'hoge';
$i = 100;

//
$v1 = 'abc';
$v2 = "abc";
var_dump($v1);
var_dump($v2);

//
$v1 = 'data is {$s}';
$v2 = "data is {$s}";
var_dump($v1);
var_dump($v2);

//
$v1 = 'data is {$i}';
$v2 = "data is {$i}";
var_dump($v1);
var_dump($v2);

//
$v1 = 'print " and \' ';
$v2 = "print \" and ' ";
var_dump($v1);
var_dump($v2);

//
$v1 = 'escape \n';
$v2 = "escape \n";
var_dump($v1);
var_dump($v2);

