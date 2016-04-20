<pre>
<?php

function empty_check($v) {
  var_dump($v);
  echo " is ";
  var_dump(empty($v));
  echo "\n";
}

//
empty_check(true);
empty_check(false);
//
empty_check(0);
empty_check(0.0);
empty_check(1);
empty_check(-1);
//
empty_check('');
empty_check(' ');
empty_check("\n");
empty_check('0'); // XXX 注意すべきところ
empty_check('0.0');
empty_check('00');
//
empty_check(array());
empty_check(array(1));
//
empty_check(fopen(__FILE__, "r"));
//
empty_check(null);
//
empty_check(new stdClass());
