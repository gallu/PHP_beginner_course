<pre>
<?php

function bool_check($v) {
  var_dump($v);
  echo " is ";
  var_dump((bool)$v);
  echo "\n";
}

//
bool_check(true);
bool_check(false);
//
bool_check(0);
bool_check(0.0);
bool_check(1);
bool_check(-1);
//
bool_check('');
bool_check(' ');
bool_check("\n");
bool_check('0'); // XXX 注意すべきところ
bool_check('0.0');
bool_check('00');
//
bool_check(array());
bool_check(array(1));
//
bool_check(fopen(__FILE__, "r"));
//
bool_check(null);
//
bool_check(new stdClass());
