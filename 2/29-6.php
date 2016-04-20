<pre>
<?php

// 扱えるhashの一覧
var_dump( hash_algos() );

// 様々なhash
$base = 'test';

//
echo 'md5: ', md5($base), "\n";

//
echo 'sha-1: ', sha1($base), "\n";

//
echo 'sha256: ', hash('sha256', $base), "\n";

