<pre>
<?php

//
$s1 = 'test';
$s2 = 'test';
$s3 = 'testhoge';
$s4 = 'TEST';
$s5 = 'TESTHOGE';

//
echo "strcmp\n";
var_dump( strcmp($s1, $s2) );
var_dump( strcmp($s1, $s3) );
var_dump( strcmp($s1, $s4) );

//
echo "\n";
echo "strncmp\n";
var_dump( strncmp($s1, $s2, 4) );
var_dump( strncmp($s1, $s3, 4) );

//
echo "\n";
echo "strcasecmp\n";
var_dump( strcasecmp($s1, $s4) );

//
echo "\n";
echo "strncasecmp\n";
var_dump( strncasecmp($s1, $s4, 4) );
var_dump( strncasecmp($s1, $s5, 4) );
